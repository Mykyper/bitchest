@extends('layout')
@section('content')
<div class="card">
    <div class="header">
     
      <h1>BITCHEST</h1>
    </div>
    <h2>UPDATE PROFILE</h2>
    <form method="POST" action="{{ route('modifier.admin') }}">
    @csrf

    <div class="form-group">
        <input type="text" name="name" placeholder="Name...">
    </div> 
    <div class="form-group">
        <input type="text" name="pseudo" placeholder="Pseudo...">
    </div>
    <div class="form-group">
        <input type="text" name="surname" placeholder="Surname...">
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="Mail...">
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password...">
    </div>
    <input type="submit" value="Submit">
</form>

  </div>
@endsection

