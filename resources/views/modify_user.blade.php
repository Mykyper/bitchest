@extends('layout')
@section('content')
<h2>UPDATE USER'S PROFILE</h2>
    <!-- Update User Form -->
    <form method="POST" action="{{ route('update_user', $user->id) }}">
    @csrf
    <!-- Champs de formulaire pour la mise à jour des données de l'utilisateur -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->nom }}">
    </div>
    <div class="form-group">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="{{ $user->prénom }}">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="mail" value="{{ $user->mail }}">
    </div>
    <button type="submit">Update</button>
</form>

    @endsection


