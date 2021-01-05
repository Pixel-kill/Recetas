<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UsuarioSeeder extends Seeder
{

    public function run()
    {
        $user=User::create([
            'name' => 'carlos',
            'email' => 'correo@correo.com',
            'password' => Hash::make('123456789'),
            'url' => 'http://ejemplo.com',
        ]);


        $user2=User::create([
            'name' => 'antonio',
            'email' => 'ejemplo@ejemplo.com',
            'password' => Hash::make('123456789'),
            'url' => 'http://ejemplo.com',
        ]);


        /* DB::table('users')->insert([
            'name' => 'carlos',
            'email' => 'correo@correo.com',
            'password' => Hash::make('123456789'),
            'url' => 'http://ejemplo.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]); */


    }
}
