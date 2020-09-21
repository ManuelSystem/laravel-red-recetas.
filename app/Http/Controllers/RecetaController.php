<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $recetas = ['Receta pizza', 'Receta hamburguesa', 'Receta garbanzo'];
        $categorias = ['Comida Mexicana', 'Comida Colombiana', 'Postres'];
        //esta sintaxis es una forma de pasar datos a la vista desde aqui el controlador
        /* return view('recetas.index')
            ->with('recetas' . $recetas)
            ->with('categorias', $categorias); */

        //otra sintaxis para pasar datos a la vista es esta, que es mas compacta para usar
        return view('recetas.index', compact('recetas', 'categorias'));
    }
}
