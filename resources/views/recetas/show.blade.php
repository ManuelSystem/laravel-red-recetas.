@extends('layouts.app')

@section('content')

<article class="contenido-receta">
    <h1 class="text-center mb-4">{{$receta->titulo}}</h1>
    <div class="imagen-receta">
        <img src="/storage/{{$receta->imagen}}" alt="imagen de la receta" class="w-100">
    </div>
    <div class="receta-meta mt-2">
        <p>
            <span class="font-weight-bold text-primary">Escrito en:</span>
            {{$receta->categoria->nombre}}
        </p>
        <p>
            <span class="font-weight-bold text-primary">Autor:</span>
            {{$receta->autor->name}}
        </p>
        <p>
            <span class="font-weight-bold text-primary">Fecha:</span>
            @php
                $fecha = $receta->created_at
            @endphp
            <fecha-receta fecha="{{$fecha}}"></fecha-receta>
        </p>

        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {{--de esta manera se elimina el codigo html con el que se guarda en la base de datos y se muestra solo la info--}}
            {!! $receta->ingredientes !!}
        </div>
        <div class="preparacion">
            <h2 class="my-3 text-primary">Preparación</h2>
            {{--de esta manera se elimina el codigo html con el que se guarda en la base de datos y se muestra solo la info--}}
            {!! $receta->preparacion !!}
        </div>
    </div>
    <div class="justify-content-center row text-center">
        <like-button
        receta-id="{{$receta->id}}"
        like="{{$like}}"
        likes="{{$likes}}">
        </like-button>
    </div>
</article>
@endsection
