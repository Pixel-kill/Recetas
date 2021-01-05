<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, Receta $receta)
    {
        //togle es para marcar cuando se dio like o desmarcar cuando no se dio like
        return auth()->user()->meGusta()->toggle($receta);
    }

}
