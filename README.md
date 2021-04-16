<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installer le projet :

Pour travailler sur le projet, on doit le cloner et on doit installer les dépendances avec Composer :
```
composer install
```

Lancer le serveur :
```
php artisan serve
```

Si le fichier .env n'existe pas, il faut le créer (par défaut, ignoré par git quand on récupère un projet):
```
cp .env.exemple .env
php artisan key:generate
```

Laravel Mix pour pouvoir faire du js, bootstrap, tailwind, SASS, etc dans Laravel
dans le dossier du projet :
```
npm install
```
Pour le css, on renomme le app.css en app.scss et à aussi modifier dans le fichier webpack.mix.js
Ensuite (à lancer 2x s'il doit retélécharger des dépendances) :
```
npm run watch
```

Nb : 2 terminaux ouverts en même temps, 1 avec php artisan serve et 1 autre avec npm run watch

Créer une migration
```
php artisan make:migration create_properties_table
```
=> création d'un nouveau fichier dans database/migrations à la date de création. Commande pour lancer l'exécution de la migration. 
```
php artisan migrate
```
Relancer la migration (si erreur)
//Nb : attention à créer la table en InnoDB =/= MyISAM et en utf8mb4_general_ci
```
php artisan migrate:fresh
```

Lancer des scripts :
```
php artisan db:seed
```
Pour remettre à 0 la base et relancer les scripts :
```
php artisan migrate:fresh --seed
```

Récupérer la page 404 :
- soit on crée une 404 pour écraser la page par défaut
- soit on utilise la commande qui copiera le dossier des erreurs dans ressources/views/errors
```
php artisan vendor:publish --tag=laravel-errors
```
Nb : si on utilise la page illustrated-layout, il faut ajouter un dossier img dans /public  et on ajoute dans illustrated-layout-blade :
```
@section('image')
    <img class=""...>
@endsection
```

Créer des contrôleurs :
```
php artisan make:controller PropertyController
```
-> création d'un dossier Controllers dans app/Http
-> 1 méthode = 1 route