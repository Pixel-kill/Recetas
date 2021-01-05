<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeRecetaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_receta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('receta_id')->references('id')->on('recetas');
            $table->timestamps();
              /* tambien se puede reemplazar con
            $table->foreignId('user_id')->constrained();
            $table->foreignId('receta_id')->constrained();
            */
        });
    }




    public function down()
    {
        Schema::dropIfExists('likes_receta');
    }
}
