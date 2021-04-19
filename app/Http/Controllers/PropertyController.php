<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB; -> plus utile car on ne passe plus que par le modèle
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    //Noms des fonctions = conventions/ bonnes pratiques mais pas obligatoires

    //afficher la liste des annonces
    public function index()
    {
        /* 
       Méthode 1 sans le modèle/ avec requête SQL
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
        */

        //Méthode 2 avec le modèle/ sans écrire de requête SQL
        return view('properties/index', [
            'properties' => Property::all(),
            //'properties' => Property::where('sold', 0)->get()
        ]);
    }

    //afficher une annonce
    public function show(Property $property)
    {
        /* Ancien code avant l'utilisation de la class Property
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
        */
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
            'image' => 'image',
            'price' => 'required|integer|gt:0',
        ]);

        //upload de l'image (image pas obligatoire donc on vérifie s'il y en a une)
        $path = null;
        if ($request->hasFile('image')) { //hasFile : vérifie si le champs image contient un fichier
            $path = $request->image->store('public/annonces'); // public/annonces.... .jpg => /storage/annonces/... .jpg
        }

        /* Méthode avant l'utilisation de la class Property
        DB::table('properties')->insert([
            //on peut utiliser $request plutôt que request() grâce au typage Request au-dessus
            'title' => $request->title,
            'description' => $request->description,
            'image' => str_replace('public', '/storage', $path),
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
        */

        Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => str_replace('public', '/storage', $path),
            'price' => $request->price,
            'sold' => $request->filled('sold'),
            //Nb : le created_at & updated_at sont créés & gérés automatiquement
        ]);

        //On redirige et on met l'annonce dans la session
        return redirect('/nos-annonces')->withInput();
    }

    //formulaire pour éditer une annonce (affichage)
    public function edit($id)
    {
        /* Avant l'utilisation de la class Property
        $property = DB::table('properties')->find($id);
        if (!$property) {
            abort(404);
        }
        */
        //findOrFail, autre méthode possible avec la class Property
        $property = Property::findOrFail($id);
        return view('properties/edit', ['property' => $property]);
    }

    //Modifier une annonce dans la BDD
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|unique:properties,title,' . $id . '|min:2',
            // unique:properties : doit être unique dans la table properties
            // on crée une exception pour le title unique quand on fait un update de l'annonce sans changer le titre (title, $id)
            'description' => 'required|string|min:15',
            'price' => 'required|integer|gt:0',
        ]);

        /*
        DB::table('properties')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->filled('sold'),
            'updated_at' => now(),
        ]);
        */
        Property::findOrFail($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->filled('sold'),
        ]);
        return redirect('/nos-annonces')
            ->with('message', 'Annonce mise à jour');
    }

    public function destroy($id)
    {
        //$property = DB::table('properties')->find($id); //vérifier qu'il y a bien une annonce
        $property = Property::findOrFail($id);

        if ($property->image) {
            Storage::delete( // ! au use pour le service Storage
                str_replace('/storage', 'public', $property->image)
            );
        }

        //DB::table('properties')->delete($id);
        $property->delete();

        return redirect('/nos-annonces')
            ->with('message', 'Annonce supprimée.');
    }
}
