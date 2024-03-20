<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <!-- Ajoutez ici vos feuilles de style CSS ou liens CDN -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>
    <div class="main">
        <div class="sidebar">
            @include('sidebar')
        </div>
        <div class="content">
            @yield('content') <!-- Laissez cette zone ouverte pour que le contenu spécifique à chaque page soit inclus ici -->
        </div>
    </div>
    


</body>

</html>