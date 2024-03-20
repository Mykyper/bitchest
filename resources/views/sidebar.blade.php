<link rel="stylesheet" href="{{ asset('../css/sidebar.css') }}">
<div class="sidebar">
    <h1>BITCHEST</h1>
    <ul>
        <li><a href="{{ url('/update.admin') }}">Update Profil</a></li>
        <li><a href="{{ url('/list.users') }}">Users</a></li>
        <li><a href="{{ url('/create') }}">Creation</a></li>
        <li><a href="{{ url('/cryptos') }}">Crypto</a> </li>
        <li><a href="{{ url('/admin/logout') }}">Logout</a> </li>
        @if(Auth::guard('admin')->check())
    <p>Welcome <br>{{ Auth::guard('admin')->user()->nom }} {{ Auth::guard('admin')->user()->prenom }} <br> alias {{ Auth::guard('admin')->user()->pseudo }}</p>
@endif </ul>
</div>
<br><br><br>
