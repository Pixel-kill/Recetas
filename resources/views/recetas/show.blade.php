@extends('layouts.app')

@section('content')

<article class="bg-light p-3">
<h1 class="text-center mb-4">{{$receta->titulo}}</h1>

<div class="imagen-receta">
<img src="/storage/{{$receta->imagen}}" class="w-100">
</div>

<div class="receta-meta mt-4">
    <p>
        <span class="font-weight-bold text-primary">Escrito en:</span>
        <a class="text-dark"
         href="{{route('categorias.show',['categoriaReceta' => $receta->categoria->id])}}">

        {{$receta->categoria->nombre}}
         </a>
    </p>

    <p>
        <span class="font-weight-bold text-primary">Autor:</span>
        <a class="text-dark"
         href="{{route('perfil.show',['perfil' => $receta->autor->id])}}">

            {{$receta->autor->name}}
         </a>
    </p>

    <p>
        <span class="font-weight-bold text-primary">Fecha:</span>
        @php

        $fecha=$receta->created_at

       @endphp

   <fecha-receta fecha="{{$fecha}}"></fecha-receta>
    </p>



    <div class="ingredientes">
        <h2 class="my-3 text-primary">Ingredientes</h2>
            {{-- Esto es para que lea la etiqueta de los ingredientes y lo imprima
            como html --}}
        {!! $receta->ingredientes!!}
    </div>

    <div class="preparacion">
        <h2 class="my-3 text-primary">preparacion</h2>
            {{-- Esto es para que lea la etiqueta de los preparacion y lo imprima
            como html --}}
        {!! $receta->preparacion!!}
    </div>

    <div class="justify-content-center row text-center">
        <like-button
        receta-id="{{$receta->id}}"
        like="{{$like}}"
        likes="{{$likes}}"
        ></like-button>
    </div>



</div>
</article>
@endsection
