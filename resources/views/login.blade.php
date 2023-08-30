<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="antialiased">
  <div class="card">
    <div class="card-header">
      <h2>Logins</h2>
    </div>
    <div class="card-body">
      <form action="{{route('autenticar')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Login</label>
          <input name="login" type="text" class="form-control" id="login" placeholder="usuario4264_00">
        </div>
        <div class="col-auto">
          <input name="password" type="password" id="password" class="form-control" aria-labelledby="passwordHelpInline">
        </div>
        <div class="row">
          <button type="submit" class="btn btn-block btn-outline-primary">Logar</button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
