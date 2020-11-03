<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //obtener las 6 recetas más nuevas, la cantidad que quiero mostrar se lo paso en el take()
        $nuevas = Receta::latest()->take(6)->get();

        //obtener todas las categorias
        $categorias = CategoriaReceta::all();
        //return $categorias;
        //agrupar las recetas por categoria
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
            //el slug permite crear guiones entre cada espacio de palabra como se ve ya en los sitios web, por ejemplo. comida-colombiana
        }
        //return $recetas;
        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
