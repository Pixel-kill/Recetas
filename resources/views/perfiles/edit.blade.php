@extends('layouts.app')

@section('botones')
<a href="{{route('receta.index')}}" class="btn btn-primary mr-2">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>Volver</a>
@endsection

@section('content')
    <h1>Editar mi Perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white-p-3">
        <form
            action="{{route('perfil.update',['perfil'=>$perfil->id]) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text"
                    name="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    id="titutlo"
                    placeholder="Tu nombre"
                    value="{{$perfil->usuario->name}}"
                   >
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="url">Sitio Web</label>

                    <input type="text"
                    name="url"
                    class="form-control @error('url') is-invalid @enderror"
                    id="titutlo"
                    placeholder="Tu url"
                    value="{{$perfil->usuario->url}}"
                   >

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>



                <div class="form-group mt-3">
                    <label for="biografia">Biografia</label>
                    <input type="hidden" name="biografia"
                    value="{{$perfil->biografia}}" id="biografia">
                    <trix-editor
                    class="form-control @error('biografia') is-invalid @enderror"
                    input="biografia" style="min-height: 300px"></trix-editor>

                    @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>



                <div class="form-group mt-3">
                    <label for="imagen">Tu imagen</label>

                    <input type="file"
                    class="form-control @error('imagen') is-invalid @enderror"
                    name="imagen"
                    id="imagen">

                </div>



                @if ($perfil->imagen)
                    <div class="mt-4">
                        <p>Imagen actual:</p>
                        <img src="/storage/{{$perfil->imagen}}" style="width:300px ">
                    </div>

                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                    @enderror
                @endif

                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Guardar Perfil">
                </div>

            </form>
        </div>
    </div>
@endsection
