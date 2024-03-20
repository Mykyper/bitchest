@extends('layout')
@section('content')
<h2>LIST OF CRYPTO</h2>
<table class="table">
    <tr>
        <th>Crypto</th>
        <th>Price(€)</th>
    </tr>
    @foreach ($cryptos as $crypto)
    <tr>
        <td>{{ $crypto->nom }}</td>
        <td>{{ $crypto->first_cotation * 0.82 }}</td> <!-- Convertir la cotation en euros -->
    </tr>
    @endforeach
</table>
</div>
@endsection

