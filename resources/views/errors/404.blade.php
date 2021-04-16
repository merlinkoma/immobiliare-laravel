@extends('errors::minimal')
{{-- :: -> utilise notre fichier modifié et s'il n'existe pas, va chercher le fichier dans le vendor. Si on utilise le . ou le /, il y aurait une erreur si le fichier était absent --}}

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
