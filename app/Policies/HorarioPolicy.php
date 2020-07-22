<?php

namespace App\Policies;

use App\User;
use App\Horario;
use Illuminate\Auth\Access\HandlesAuthorization;

class HorarioPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
            return true;

        }
    }

    public function view(User $user,Horario $horario )
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View Horario');
    }
    public function create(User $user ,Horario $horario)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create Horario');
    }
    public function update(User $user ,Horario $horario)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update Horario');
    }
    public function delete(User $user ,Horario $horario)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete Horario');
    }

}
