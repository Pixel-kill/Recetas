@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')

    <h2 class="text-center mb-5" >ADMINISTRA TUS RECETAS </h2>
    <div class="col-md-10 mx-auto bg-white p-3" >
        <table class="table">
            <thead class="bg-primary text-ligth">
                <tr>
                    <th scole="col">titulo</th>
                    <th scole="col">categoria</th>
                    <th scole="col">acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($recetas as $receta)

                <tr>
                    <td> {{$receta->titulo}} </td>
                    <td> {{$receta->categoria->nombre}} </td>
                    <td>


                    <eliminar-receta
                    receta-id={{$receta->id}}
                    >
                    </eliminar-receta>

                    <a href="{{route('receta.edit',['receta' =>$receta->id])}}" class="btn btn-dark mr-1 d-block w-100 mb-2" >Editar</a>
                    <a href="{{route('receta.show',['receta' =>$receta->id])}}" class="btn btn-success mr-1 d-block w-100 ">Ver</a>

                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if ( count($usuario->meGusta) > 0)
                <ul class="list-group">
                    @foreach ($usuario->meGusta as $receta)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{$receta->titulo}}</p>
                            <a class="btn btn-outline-success text-uppercase font-weight-bold"
                            href="{{route('receta.show',['receta' =>$receta->id])}}">Ver
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center">
                    Aun no tienes recetas Guardadas
                    <small> Dale me gusta a las recetas y apareceran aqui</small>
                </p>

            @endif
        </div>
    </div>
@endsection



