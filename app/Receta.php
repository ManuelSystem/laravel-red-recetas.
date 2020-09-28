<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //campos que se agregaran
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id',
    ];

    //obtiene la categoria de la receta via FK
    public function categoria()
    {
        //con esto hago la relación de uno a uno
        return $this->belongsTo(CategoriaReceta::class);
    }
    //obtiene la informacion del usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); //el FK de esta tabla
    }
}
