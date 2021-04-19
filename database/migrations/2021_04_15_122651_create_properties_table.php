<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //string = VARCHAR
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('price');
            $table->boolean('sold');
            $table->foreignId('user_id')->nullable()->constrained(); //! la table user doit exister avant de faire un lien
            //constrained() : contrainte de clef étrangère (empêche par exemple de supprimer un utilisateur lié à une annonce).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
