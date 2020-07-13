<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complejo extends Model
{
    protected $fillable = [

        'nombre', 'ubicacion', 'telefono'
    ];
    
    public function getRouteKeyName()
    {
        return 'url';
    }
    public function canchas(){ 
        return $this->hasMany(Cancha::class);
    }
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function delete()
    {
        // Borra todos los comentarios 
        foreach($this->cancha as $canchas)
        {
            $canchas->delete();
        }

        // Borramos el Post
        return parent::delete();
    }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = $nombre;
        $this->attributes['url'] = str_slug($nombre);
    }

    
    
}
