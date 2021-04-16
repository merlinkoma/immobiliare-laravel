@extends('layouts.app');

@section('content')
    {{-- FORMULAIRE EN GET --}}
    <div class="container">
        <h2>Formulaire en GET</h2>
        <form class="my-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <button class="btn btn-dark mb-3 my-2">Envoyer</button>
        </form>
        @if (request('name'))
            Bonjour {{ request('name') }} !
        @endif

        @if ($errors->any())
        {{-- Nb : pas besoin des doubles accolades ci-dessus car on est déjà dans une expression blade. On en a donc besoin dans le <li> --}}
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORMULAIRE EN POST --}}
        <h2>Formulaire en POST</h2>
        {{-- Nb : l'action est ici renseignée pour l'exemple mais avec la valeur par défaut --}}
        <form action="/annonce/creer" class="my-2" method="post">
            @csrf
            {{-- envoi un token dans la session à chaque requête pour éviter les failles csrf 
            Equivaut à un input de type hidden avec un name="_token" et value"..."
            Laravel va vérifier que le token envoyé correspond à celu ide la personne sur le site --}}
            <div>
                <label for="title" class="form-label">Titre de l'annonce</label>
                <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                {{-- exemple d'erreur affichée directement sous le champ concerné --}}
                @error('title')
                    <span class="form-control alert alert-danger">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" value="{{old('description')}}"></textarea>
            </div>

            <div>
                <label for="price" class="form-label">Prix</label>
                <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}">
            </div>

            <div class="form-check">
                <input type="checkbox" name="sold" id="sold" class="form-check-input" {{old('sold') ? 'checked' : ''}}>
                <label for="sold" class="form-label">Vendu ?</label>
            </div>

            <button class="btn btn-dark mb-3 my-2">Envoyer</button>
        </form>
        @if (request('name'))
            Bonjour {{ request('name') }} !
        @endif
    </div>
@endsection
