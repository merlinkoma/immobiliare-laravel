<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<!-- renvoie la langue de l'application @dump(app()->getLocale()) -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{-- Ici on utilise @section plutôt que @yield pour pouvoir définir du contenu par défaut et récupérer la valeur du parent dans la section enfant --}}
        @section('title')
            Laravel Immobiliare
        @show
        {{-- Pas besoin de @endsection --}}
    </title>
    {{-- Nb : mix() gère les problèmes de cache --}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Immobiliare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Accueil</a>
                    <a class="nav-link {{ request()->is('a-propos') ? 'active' : '' }}" href="/a-propos">A propos</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- request() : permet de récupérer les informations de la requête, notamment la page active --}}
    
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
