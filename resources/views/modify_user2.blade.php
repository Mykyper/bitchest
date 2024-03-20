@extends('user_layout')
@section('content')

<h2>UPDATE USER'S PROFILE</h2>
<form method="POST" action="{{ route('update.user', $user->id) }}">
    @csrf
    
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
        <input type="email" id="email" name="email" value="{{ $user->mail }}">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="submit">Update</button>
</form>

@endsection
