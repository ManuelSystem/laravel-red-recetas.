<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    //con este constructor se protege las vistas, es decir solo puede acceder a ellas usuarios
    //autenticados
    public function __construct()
    {
        //con esto laravel obliga a estar logueado al usuario para realizar los distintas acciones, con expcion del metodo show
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->recetas->dd(); con esto verifico en pantalla las recetas que tengo del usuario actual logueado

        $recetas = Auth::user()->recetas;
        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Con este codigo se hace una consulta a la base de datos, en este caso le digo que me muestre los cam-
        //pos de nombre y id de la tabla categoria_receta.
        // DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();

        //De esta manera se obtiene las categorias sin modelo
        //$categorias =  DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        //De esta manera se obtiene las categorias con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*con este codigo se guardan las imagenes en el disco duro del servidor'public', si se esta trabajando en amazon y se va a guardar las imagenes
        en la nube, en vez de public se guarda como 'aws'*/
        //dd($request['imagen']->store('upload-recetas', 'public'));

        //validacion
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
        ]);

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize de la imagen, esto guarda la imagen con un ancho y altor predeterminado, se logra con la libreria de intervention image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        //almacenar en la base de datos(sin modelo)
        /* DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria'],
        ]); */

        //almacenar en la base de datos(con modelo)
        //lo que se indica como recetas, es la función que se encuentra en el modelo de User
        Auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria'],
        ]);


        // dd($request->all());--con este codigo se puede verificar en formato json lo que se está guardando
        //de aqui una vez insertados los valores en la bd, se debe redireccionar ese post
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //se retorna lo que haya en el metodo show del web.php
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //De esta manera se obtiene las categorias con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        //muestra los campos co los datos de la DB a editar
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //revisar el policy
        $this->authorize('update', $receta);
        //validacion
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
        ]);

        //asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        //si el ususario sube una nueva imagen
        if (request('imagen')) {
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //Resize de la imagen, esto guarda la imagen con un ancho y altor predeterminado, se logra con la libreria de intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //asignar la img al objeto
            $receta->imagen = $ruta_imagen;
        }
        $receta->save();

        //redireccionar una vez actualizado
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //ejecutar el poliy
        $this->authorize('delete', $receta);

        //Eliminar la receta
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }
}
