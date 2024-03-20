@extends('user_layout')
@section('content')
<div class="dashboard">
    <div class="section portfolio">
        <h2>Wallet</h2>
        @if(Auth::check() && Auth::user()->wallet)
    <h3>Amount : {{ Auth::user()->wallet->somme }} €</h3>
@endif
        <form action="{{ route('approvisionner') }}" method="post">
            @csrf
            <input type="number" name="montant" placeholder="Montant à ajouter">
            <button type="submit">Add MONEY</button>
        </form>
        
        <!-- Ajoutez d'autres actions ici -->
    </div>
</div>


<style>
  .dashboard {
    width: 80%;
    margin: 0 auto;
}

.section {
    background-color: #f4f4f4;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.portfolio-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-gap: 20px;
}

.stock {
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.stock-name {
    font-weight: bold;
}

.stock-value,
.stock-change {
    margin-top: 5px;
    font-size: 14px;
    color: #666;
}

</style>
@endsection