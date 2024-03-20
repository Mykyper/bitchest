@extends('User_layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Currency</th>
            <th>Value</th>
            <th>Value change on the last 24h</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cryptos as $crypto)
        <tr>
            <td>{{ $crypto->nom }}</td>
            <td>{{ $crypto->first_cotation  }}</td>
            <td>{{ $crypto->last_cotation  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

  @endsection