@extends('layouts.app')

@section('botones')
<a href="{{route('recetas.create')}}" class="btn btn-primary mr-2 text-white">Crear Receta</a>
@endsection
@section('content')
<h2 class="text-center mb-5">Administra tus Recetas</h2>

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Título</th>
                <th scole="col">Categoría</th>
                <th scole="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--con este for recorro el arreglo de la variable $recetas del Recetacontroller, que es lo que
            le estoy cargando a la vista desde el controller.-->
            @foreach ($recetas as $receta)
            <tr>
                <td>{{$receta->titulo}}</td>
                <td>{{$receta->categoria->nombre}}</td>
                <td>
                    <a href="" class="btn btn-danger mr-1">Eliminar</a>
                    <a href="" class="btn btn-dark mr-1">Editar</a>
                    <a href="" class="btn btn-success mr-1">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

