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
            session()->flash('errors', ['message' => 'Usuário inválido ou credenciais incorretas']);
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
            session()->flash('errors', ['message' => 'Usuário não autorizado! Entre em contato com administrador']);
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
            $this->guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $request->user()->tokens()->delete();

            if ($response = $this->loggedOut($request)) {
                return $response;
            }

            return new JsonResponse([], 204);
        }catch(Exception $e){
            return new JsonResponse($e->getMessage(), 500);
        }

    }

    public function loginMicrosoft()
    {
        return Socialite::driver('microsoft')->scopes(['User.Read'])->redirect();
    }

    public function loginMicrosoftCallback()
    {
        $user = Socialite::driver('microsoft')->user();

        dd($user);
    }
}
