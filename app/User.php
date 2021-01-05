<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Ui\Presets\React;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','url',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        parent::boot();

        static::created(function($user){
            $user->perfil()->create();
        });
    }

    /**Relaciond de uno a muchos(1.n)  de usuario receta */
     public function recetas(){
        return $this->hasMany(Receta::class);
    }

    //Relacion 1:1  de usuario y perfil
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }


    //recetas que el usuario le ha dado me gusta
    public function meGusta(){
        //muchos a muchos
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }



}
