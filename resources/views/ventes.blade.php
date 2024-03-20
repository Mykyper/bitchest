@extends('user_layout')
@section('content')
<form action="{{ route('vendre-crypto') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="crypto_achat_id">Sélectionnez l'achat de crypto-monnaie à vendre :</label>
        <select class="form-control" name="crypto_achat_id" id="crypto_achat_id">
            @foreach ($achats as $achat)
                <option value="{{ $achat->id }}">{{ $achat->crypto->nom }} - {{ $achat->quantite }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Vendre</button>
</form>
@endsection