<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    //Noms des fonctions = conventions/ bonnes pratiques mais pas obligatoires

    //afficher la liste des annonces
    public function index()
    {
        //$properties = DB::select('select * from properties'); ==>
    $properties = DB::table('properties')
    ->where('sold', 0)
    ->where('sold', '=', 1, 'or')
    ->get();
    //les 2 where sont inutiles mais laissés ici pour l'exemple
    // ! à bien faire le use
    return view('properties.index', [
        'properties' => $properties,
    ]);
    }

    //afficher une annonce
    public function show($id)
    {
        $property = DB::table('properties')
            ->where('id', $id)
            ->get()->first();
        //le get() renvoie une collection, le first() ne retourne que le 1er donc pas besoin d'aller chercher l'index[0] dans les paramètres de la view
        //autre solution : $property = DB::table('properties')->find($id); raccourci pour where et first
        //on ajoute : 
        if (!$property) {
            abort(404);
        }
        //-> renvoie une 404
        //OU : BD::selectOne(...)

        return
            //@dump($property);
            view('properties/show', ['property' => $property,]);
    }

    //créer une annonce (formulaire en post)
    public function create()
    {
        return view('properties/create');
    }

    //enregistrer l'annonce dans la BDD
    public function store(Request $request)
    {
        //Request permet de typer la requête
        //requête permettant le traitement du formulaire

        //Validation du formulaire, arrête le code en cas d'erreur
        $request->validate([
            'title' => 'required|string|unique:properties|min:2',
            'description' => 'required|string|min:15',
            'price' => 'required|integer|gt:0',
        ]);

        DB::table('properties')->insert([
            //on peut utiliser $request plutôt que request() grâce au typage Request au-dessus
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->filled('sold'),
            'created_at' => now(),
            'updated_at' => now(),
            //filled : renvoie true ou false.
        ]);

        //Autre solution encore plus rapide
        // DB::table('properties')->insert(
        //     $request->all('title', 'description', 'price') + ['sold' => $request->filled('sold')];
        // );

        //On redirige et on met l'annonce dans la session
        return redirect('/nos-annonces')->withInput();
    }
}
