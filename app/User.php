<?php

namespace App;


use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Love\Liker\Models\Liker as LikerContrat;
use App\Reserva;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable implements LikerContrat
{
   
    use Notifiable, HasRoles, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id','complejo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

  public function cancha()
    {
        return $this->hasMany(Cancha::class);
    } 
    public function complejo()
    {
        return $this->belongsToMany(Complejo::class);
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
           return $query->where('id',auth()->id());
        }
    }

    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('display_name')->implode(' - ');
    }
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
