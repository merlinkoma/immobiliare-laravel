@extends('layouts.app');

@section('content')
    <div class="container">
        <h2>Modifier {{$property->title}}</h2>
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

        <form action="" class="my-2" method="post">
            @csrf
            {{-- Nb : utile avec les formulaires en post =/= get --}}
            @method('put')
            {{-- Vaut un input caché name="_method" value="put" car la method put n'existe aps dans les balises html --}}
            <div>
                <label for="title" class="form-label">Titre de l'annonce</label>
                <input type="text" name="title" id="title" class="form-control" value="{{old('title') ?? $property->title}}">
                {{-- exemple d'erreur affichée directement sous le champ concerné --}}
                @error('title')
                    <span class="form-control alert alert-danger">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{old('description') ?? $property->description}}</textarea>
            </div>

            <div>
                <label for="price" class="form-label">Prix</label>
                <input type="text" name="price" id="price" class="form-control" value="{{old('price') ?? $property->price}}">
            </div>

            <div class="form-check">
                <input type="checkbox" name="sold" id="sold" class="form-check-input" {{old('sold', $property->sold) ? 'checked' : ''}}>
                {{-- Valeur par défaut = valeur dans la BDD, sinon, ce qui a été fait (coché ou décoché) --}}
                <label for="sold" class="form-label">Vendu ?</label>
            </div>

            <button class="btn btn-dark mb-3 my-2">Envoyer</button>
        </form>
        @if (request('name'))
            Bonjour {{ request('name') }} !
        @endif
    </div>
@endsection
