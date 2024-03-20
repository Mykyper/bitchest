@extends('layout')
@section('content')
<div class="content">
    <h2>USERS LIST</h2>
    <!-- Users List Table -->
    <table class="table">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Mail</th>
        <th>Settings</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->nom }}</td>
        <td>{{ $user->prénom }}</td>
        <td>{{ $user->mail }}</td>
        <td>
            <button ><a href="{{ route('update_user_form', $user->id) }}"style="text-decoration: none;color:green">Update</a> </button>
            <button > <a href="{{ route('show_delete_confirmation', $user->id) }}"style="text-decoration: none;color:red">Delete</a></button>
        </td>
    </tr>
    @endforeach
</table>

    @endsection

