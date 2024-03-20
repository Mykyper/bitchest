<link rel="stylesheet" href="{{ asset('../css/sidebar.css') }}">
<div class="sidebar">
  <!-- Logo et utilisateur -->
  @if(Auth::check())
  <div>
    <h2>Logo Bitchest</h2>
    <p> <br>{{ Auth::user()->nom }} {{ Auth::user()->prénom }}   <br>
    {{ Auth::user()->mail }}</p>
  </div>
@endif
  <!-- Navigation -->
  <ul>
    <li> <a href="{{ route('edit_user') }}">Update Profile</a></li>
    <li><a href="{{ route('cryptos.user') }}">Home</a></li>
    <li> <a href="{{ route('user_wallet') }}">Wallet</a></li>
    <li><a href="{{ route('achat.create')}}">Buy Cryptocurrency</a></li>
    <li><a href="{{route('vente-formulaire')}}">Sell Cryptocurrency</a></li>
  </ul>
</div>