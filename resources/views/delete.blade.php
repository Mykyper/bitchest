@extends('layout')

@section('content')

<h2>DELETE A USER</h2>

<!-- Confirmation de suppression de l'utilisateur -->

<div class="delete-confirmation">
  <p>Are you sure you want to delete this user ?</p>
  <form action="{{ route('delete_user', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Yes</button>
  </form>
  <button onclick="window.history.back()">No</button> <!-- Retour en arrière si l'utilisateur ne veut pas supprimer -->
</div>

@endsection
