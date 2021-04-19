@extends('layouts/app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Annonce {{ $property->id }}</h1>
        <div class="card mx-auto text-center col-lg-6">
            <img src="{{$property->image}}" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title" style="color: rgb(187, 82, 12)">
                    {{ $property->title }}</h5>
                <p class="card-text" style="color: rgb(9, 47, 83)">{{ $property->description }}</p>

            </div>
            <div class="card-footer text-muted">
                {{ number_format($property->price) }} €

            </div>
        </div>
    </div>
@endsection
