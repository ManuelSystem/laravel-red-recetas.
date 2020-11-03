<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento que se ejecuta cuando es creado
    protected static function boot()
    {
        parent::boot();
        //en este caso se dice que vamos a usar el metodo.Asignar perfil una vez se haya creado un usuario nuevo
        static::created(function ($user) {
            //con esto se dice que una ve creado el usuario se crea el perfil
            $user->perfil()->create();
        });
    }

    //Relación 1:n de Usuario a Recetas
    public function recetas()
    {
        //con esto hago la relación de que un usuario tiene una receta
        return $this->hasMany(Receta::class);
    }

    //Relación 1:1 de usuario a perfil
    public function perfil()
    {
        //con esto hago la relación de que un usuario tiene un perfil
        return $this->hasOne(Perfil::class);
    }

    //recetas a las que el usuario le ha dado me gusta o like
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
