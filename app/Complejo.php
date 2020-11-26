<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Complejo extends Model
{
    protected $fillable = [

        'nombre','url_imagen', 'ubicacion','latitude','longitude', 'telefono'
    ];

    public $appends = [
        'coordinate', 'map_popup_content',
    ];
    

    protected static function boot ()
    {
        parent::boot();

        static::deleting(function($complejo){

            $complejo = str_replace('storage/' , '' , $complejo->url_imagen );
            Storage::disk('public')->delete($complejo);
            
            /* Storage::disk('public')->delete($photo->url);   */ 

            /* $photoPath = str_replace('storage',  $photo->url); 

        Storage::delete($photoPath); */

        });

        
        
    }
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
        if (is_array($this->cancha) || is_object($this->cancha))
        {
            foreach($this->cancha as $canchas)
        {
            $canchas->delete();
        }
        }

        

        // Borramos el Post
        return parent::delete();
    }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = $nombre;
        $this->attributes['url'] = str_slug($nombre);
    }

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'nombre' => $this->nombre, 'type' => __('outlet.outlet'),
        ]);
         $link = '<a href="'.route('complejos.show', $this).'"'; 
        $link .= ' title="'.$title.'">';
        $link .= $this->nombre;
        $link .= '</a>';

        return $link;
    }

    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }

    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2">'.$this->name_link.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__($this->telefono).'</strong><br>'.'</div>';

        return $mapPopupContent;
    }

    
    
}
