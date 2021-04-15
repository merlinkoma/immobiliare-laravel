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