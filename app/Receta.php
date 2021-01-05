<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Receta extends Model
{

//FILLABLE estos atributos tienen que ser llenados si o si >:v
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes','imagen','categoria_id'
    ];


//Obtiene la categoria de la receta via FK
    public function categoria(){

        //uno a uno
        return $this->belongsTo(CategoriaReceta::class);

    }

//Obtiene la informacion del usuario via FK
    public function autor(){
        //uno a uno
        return $this->belongsTo(User::class,'user_id');//FK de autor
    }

//Likes que ha recibido una receta

    public function likes(){
        //muchos a muchos
        return $this->belongsToMany(User::class, 'likes_receta');
    }


}
