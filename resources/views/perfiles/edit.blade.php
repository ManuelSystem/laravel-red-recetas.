@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
<a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    Volver</a>
@endsection

@section('content')
<h1 class="text-center">Editar mi Perfil</h1>

<div class="row justify-content-center">
    <div class="col-md-10 bg-white p-3">
        <form action="{{ route('perfiles.update', ['perfil' => $perfil->id])}}" method="POST" enctype="multipart/form-data">
            @csrf{{--con esta directiva lo que se hace es verificar el token--}}
            @method('put')

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                value="{{$perfil->usuario->name}}" id="nombre" placeholder="Tu Nombre">
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">Sitio Web:</label>
                <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                value="{{$perfil->usuario->url}}" id="url" placeholder="Tu Sitio Web">
                @error('url')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label for="biografia">Biografia:</label>
                <input type="hidden" id="biografia" name="biografia" value="{{$perfil->biografia}}">
                <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia" ></trix-editor>
                @error('biografia')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label for="imagen">Carga tu nueva imagen</label>
                <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">
                @if ($perfil->imagen)
                <div class="mt-4">

                    <p>Imagen Actual:</p>
                    <img src="/storage/{{$perfil->imagen}}" alt="imagen actual del perfil" style="width: 400px">
                </div>
                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
            </div>
        </form>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection
