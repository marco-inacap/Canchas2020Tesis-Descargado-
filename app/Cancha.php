<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use App\Reserva;


class Cancha extends Model implements LikeableContract
{
    use Likeable;

    protected $fillable = [

        'nombre', 'precio', 'descripcion', 'iframe', 'complejo_id', 'estado_id','color', 'total_visitas', 'user_id'
    ];

    public function reservas()
    {
        return $this->hasOne(Reserva::class);
    }
    public function horario()
    {
        return $this->hasOne(Horario::class);
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view',$this))
        {
           /*  $canchas = Cancha::all(); */
           return $query;
        }
        else
        {
            /*  $canchas = Cancha::where('user_id',auth()->id())->get();  */
           /*  $canchas = auth()->user()->canchas; */
           return $query->where('user_id',auth()->id()); 
        }
    }

    public function total()
    {
        
    }

    protected static function boot (){

        parent::boot();

        static::deleting(function($cancha){

            $cancha->photos->each->delete();

        });
    }

    public function complejo(){ //$cancha->complejo->nombre
        return $this->belongsTo(Complejo::class); //Pertenece a un complejo.
    }

    public function photos(){ //$cancha->complejo->nombre
        return $this->hasMany(Photo::class); //Pertenece a un complejo.
    }
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function estado(){ //$cancha->estado->nombre
        return $this->belongsTo(Estado::class); //Pertenece solo a un estado.
    }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = $nombre; 

        $originalUrl = $url = str_slug($nombre);
        $count = 1;

        while (Cancha::where('url',$url)->exists())
        {
            $url = "{$originalUrl}-" . ++$count;
        }

        $this->attributes['url'] = $url;
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id(); 
        $cancha = static::query()->create($attributes);

        $cancha->generateUrl();

        
        return $cancha;
    }

    public function generateUrl()
    {
        $url = str_slug($this->nombre);

        if($this->where('url', $url)->exists())
        {
            $url = "{$url}-{$this->id}";       
        }

        $this->url = $url;

        $this->save();
    } 

    public function isPublished()
    {
        
        return ! is_null($this->precio);
    }
    
}
