<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        //almacena los likes de un usuario a una receta
        return auth()->user()->meGusta()->toggle($receta); //el toogle va a saber si ya está el like lo va a quitar, sino está como me gusta lo va a gregar

    }
}
