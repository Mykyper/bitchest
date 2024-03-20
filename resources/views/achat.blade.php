@extends('user_layout')
@section('content')
<h2>Acheter de la crypto</h2>

<form action="{{ route('achat.store') }}" method="POST">
    @csrf

    <div>
        <label for="crypto_id">Crypto:</label>
        <select name="crypto_id" id="crypto_id">
            @foreach ($cryptos as $crypto)
            <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="quantite">Quantité:</label>
        <input type="number" name="quantite" id="quantite" min="1" required>
    </div>

    <button type="submit">Acheter</button>
</form>
@endsection