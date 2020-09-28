<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //obtiene la categoria de la receta via FK
    public function categoria()
    {
        //con esto hago la relación de uno a uno
        return $this->belongsTo(CategoriaReceta::class);
    }
}
