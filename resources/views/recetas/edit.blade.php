@extends('layouts.app')



@section('botones')
<a href="{{route('receta.index')}}" class="btn btn-primary mr-2">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
    Volver</a>
@endsection




@section('content')

<h2 class="text-center mb-5">Editar receta: {{$receta->titulo}}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <form method="POST"
             action="{{route('receta.update',['receta'=>$receta->id])}}" enctype="multipart/form-data" novalidate>

                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="titulo">Titulo Recenta</label>

                        <input type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titutlo"
                        placeholder="Titulo Receta"
                        value="{{$receta->titulo}}">


                        @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="from-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" >
                            <option value="">--Seleccione--</option>

                            @foreach ($categorias as $categoria)
                            <option
                            value="{{$categoria->id}}"
                            {{$receta->categoria_id==$categoria->id?'selected':''}}
                            >{{$categoria->nombre}}</option>
                            @endforeach

                        </select>

                        @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-group mt-3">
                        <label for="preparacion">Preparacion</label>
                        <input type="hidden" name="preparacion"
                        value="{{$receta->preparacion}}" id="preparacion">
                        <trix-editor
                        class="form-control @error('preparacion') is-invalid @enderror"
                        input="preparacion" style="min-height: 300px"></trix-editor>

                        @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <label for="ingredientes">ingredientes</label>
                        <input type="hidden" name="ingredientes"
                        value="{{$receta->ingredientes}}" id="ingredientes">

                        <trix-editor
                        class="form-control @error('ingredientes') is-invalid @enderror"
                        input="ingredientes" style="min-height: 300px"></trix-editor>

                        @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="imagen">Elije una imagen</label>

                        <input type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                        id="imagen">

                        @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <p>Imagen actual:</p>
                        <img src="/storage/{{$receta->imagen}}" style="width:300px ">
                    </div>



                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" value="Guardar Receta">
                    </div>
            </form>
        </div>

    </div>
@endsection


