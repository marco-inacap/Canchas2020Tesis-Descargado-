<?php

namespace App\Policies;

use App\User;
use App\Cancha;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class CanchaPolicy
{
    use HandlesAuthorization;


    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
            return true;

        }
    }

    /**
     * Determine whether the user can view the cancha.
     *
     * @param  \App\User  $user
     * @param  \App\Cancha  $cancha
     * @return mixed
     */
    public function view(User $user, Cancha $cancha)
    {
        return $user->id === $cancha->user_id || $user->hasPermissionTo('View Cancha');
    }

    /**
     * Determine whether the user can create canchas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Cancha $cancha)
    {
        /* dd('ejecutado'); */
        return $user->hasPermissionTo('Create Cancha');
    }

    /**
     * Determine whether the user can update the cancha.
     *
     * @param  \App\User  $user
     * @param  \App\Cancha  $cancha
     * @return mixed
     */
    public function update(User $user, Cancha $cancha)
    {
        return $user->id === $cancha->user_id || $user->hasPermissionTo('Update Cancha'); 
    }

    /**
     * Determine whether the user can delete the cancha.
     *
     * @param  \App\User  $user
     * @param  \App\Cancha  $cancha
     * @return mixed
     */
    public function delete(User $user, Cancha $cancha)
    {
        return $user->id === $cancha->user_id || $user->hasPermissionTo('Delete Cancha'); 
    }
}
