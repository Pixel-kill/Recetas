<?php

 namespace App;

use Illuminate\Database\Eloquent\Model;


class Perfil extends Model
{
    public function usuario(){

        //uno a uno
        return $this->belongsTo(User::class,'user_id');
    }
}

