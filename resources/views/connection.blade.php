<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/connection.css') }}">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>CONNEXION</h2>
   <form method="POST" action="{{ route('connexion') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email :</label>
        <input id="email" type="email" name="email" required autocomplete="email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Se connecter</button>
</form>

    @if ($errors->any())
      <div class="alert alert-danger" style="color:red">
        <ul>
          @foreach ($errors->all() as $error)
            <li style="list-style-type: none;">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>


</body>
</html>

