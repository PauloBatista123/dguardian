<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Services\LdapService;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Config;
use Spatie\WebhookServer\WebhookCall;
use App\Http\Services\SignatureHook;
use App\Http\Services\UsuarioService;
use App\Jobs\ProcessLogoutUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected LdapService $ldapService)
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $result = $this->ldapService->connect($request->get('email'), $request->get('password'));

        if(is_null($result) || !$result){
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);
            session()->flash('error', ['message' => 'Usuário inválido ou credenciais incorretas']);
            return redirect()->back();
        }

        $user = User::firstOrCreate(['email' => $request->get('email')], [
            'name' => $result['user'],
            'last_login' => now(),
            'ip_login' => $request->getClientIp(),
            'description' => $result['description'],
            'email_address' => $result['email'],
            'cpf' => $result['cpf'],
        ]);

        if($user->status != 'ativo'){
            $this->incrementLoginAttempts($request);
            session()->flash('error', ['message' => 'Usuário não autorizado! Entre em contato com administrador']);
            return redirect()->back();
        }

        Auth::login($user);
        Auth::user()->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'ip_login' => $request->getClientIp()
        ]);

        if ($request->hasSession()) {
            $request->session()->put('auth.password_confirmed_at', time());
        }

        return $this->sendLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        array_push($credentials, ['status' => 'ativo']);

        return $this->guard()->attempt(
            $credentials, $request->boolean('remember'),
        );
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try{

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $request->user()->tokens()->revoke();

            $request->session()->flush();

            if ($response = $this->loggedOut($request)) {
                return $response;
            }

            return new JsonResponse([], 204);
        }catch(Exception $e){
            return new JsonResponse($e->getMessage(), 500);
        }

    }

    public function getConfig()
    {
        return new Config(
            env('AZURE_CLIENT_ID'),
            env('AZURE_CLIENT_SECRET'),
            env('AZURE_REDIRECT_URI'),
            ['tenant' => env('AZURE_TENANT_ID', 'common'), 'prompt' => 'none'],
        );
    }

    public function loginMicrosoft()
    {
        return Socialite::driver('azure')->redirect();
    }

    public function loginMicrosoftCallback(Request $request)
    {
        $userMicrosof = Socialite::driver('azure')->user();

        $user = User::where('email_address', $userMicrosof->getEmail())->first();

        if($user->status != 'ativo'){
            session()->flash('error', ['message' => 'Usuário não autorizado! Entre em contato com administrador']);
            return redirect()->route('login');
        }

        Auth::login($user);
        Auth::user()->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'ip_login' => $request->getClientIp()
        ]);

        if ($request->hasSession()) {
            $request->session()->put('auth.password_confirmed_at', time());
        }

        return $this->sendLoginResponse($request);
    }
}
