@extends('layout')
@section('content')
<div class="main-content">
  <h2>CREATE A NEW USER</h2>

<form method="POST" action="{{ route('users.create') }}">
    @csrf

    <div class="form-group">
        <input type="text" name="name" placeholder="Name...">
    </div>
    <div class="form-group">
        <input type="text" name="surname" placeholder="Surname...">
    </div>
    <div class="form-group">
        <input type="text" name="pseudo" placeholder="Pseudo...">
    </div>
    <div class="form-group">
        <input type="email" name="mail" placeholder="Mail...">
    </div>

    <input type="submit" value="Create">
</form>
@if (isset($password))
    <p>Random Generated Password: {{ $password }}</p>
@endif


</div>
@endsection

