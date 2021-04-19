<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/a-propos', function () {
    $name = "Merlin";

    return view('about', [
        //On peut passer un tableau en paramètre du return. Il permet de créer des variables qui pourront être utilisées dans la vue.
        'name' => $name,
        'pauses' => ['10:30', '12:30', '15:30', '17:00'],
    ]);
});

// Route dynamique pour remplacer les $_GET
//On peut taper .../hello/merlin, on aura "Hello merlin" sur la page obtenue
//SIO -> nice !
// ! paramètre obligatoire par défaut : .../hello/ sans param => 404
// Valeur par défaut : ="...", ! bien ajouter le "?" dans le chemin.
Route::get('/hello/{firstname?}', function ($firstname = "Merlin"){
 return "<h1>Hello $firstname</h1>";
})->where('firstname', '.{2,}');
//->where(...) = regex qui demande au moins 2 caractères ("." : n'importe quel caractère)

//Route permettant d'afficher les annonces
Route::get('/nos-annonces', [PropertyController::class, 'index']);

//Voir une annonce
Route::get('/annonce/{property}', [PropertyController::class, 'show'])->whereNumber('property'); //permet de forcer un nombre en paramètre et dene pas avoir de problème avec la route du dessous annonce/creer (sinon creer est compris comme étant l'id)

//Route en GET
Route::get('/annonce/creer', [PropertyController::class, 'create']);
//1er param du tableau : nom de la classe utilisée, 2e : action appelée (ici = function create)

//Route en POST
//! use Illuminate/Http/Request;
Route::post('/annonce/creer', [PropertyController::class, 'store']);

//Editer une annonce
Route::get('/annonce/editer/{id}', [PropertyController::class, 'edit']);
Route::put('/annonce/editer/{id}', [PropertyController::class, 'update']);
//Méthode put() : distinction de la création et de la modificationd'un objet. On pourrait utiliser un post() mais plus propre avec put()

Route::delete('annonce/{id}', [PropertyController::class, 'destroy']);
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
