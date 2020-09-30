<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //mostrar un solo perfil
        return view('perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //editar datos de perfil
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //validacion de datos
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        //si el usuario sube una imagen
        if ($request['imagen']) {
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize de la imagen, esto guarda la imagen con un ancho y altor predeterminado, se logra con la libreria de intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        //asignar nombre y url

        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //eliminar url y name de $data
        unset($data['url']);
        unset($data['nombre']);

        //Guardar información
        //asignar biografia y imagen
        $perfil->biografia = $data['biografia'];
        auth()->user()->perfil()->update(array_merge( //array_merge toma 2 arreglos o más
            $array_imagen ?? []
        ));
        $perfil->save();


        //redireccionar
        return redirect()->action('RecetaController@index');
    }
}
