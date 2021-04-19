@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="d-flex my-4 justify-content-around align-items-center">
            <h1>Nos annonces</h1>
            <a href="/annonce/creer" class="btn btn-dark">Créer une annonce</a>
        </div>

        {{-- old() => y a-t-il eu une requête juste avant ?/ récupère le withInput dans la route en post = données de la requête précédente --}}
        @if (old())
            <div class="alert alert-success">
                L'annonce {{ old('title') }} a été ajoutée avec succès.
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            @foreach ($properties as $property)
                {{-- @dump($property) --}}

                <div class="col-lg-3">
                    <div class="card my-2 text-center">
                        <img src="{{$property->image}}" alt="">
                        <div class="card-body">
                            <h5 class="card-title" style="color: rgb(187, 82, 12)">
                                {{ $property->title }}</h5>
                            <p class="card-text" style="color: rgb(9, 47, 83)">{{ Str::limit($property->description, 20) }}
                            </p>
                            <a href="/annonce/{{ $property->id }}" class="btn btn-dark my-2">Voir l'annonce</a>
                            <a href="/annonce/editer/{{ $property->id }}" class="btn btn-secondary my-2">Editer l'annonce</a>
                            <form action="/annonce/{{$property->id}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer l\'annonce ?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-warning">Supprimer l'annonce</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            {{ number_format($property->price) }} €
                            {{-- number_format() : méthode pour formater les chiffres (ajoute une virgule pour faciliter la lecture) --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
