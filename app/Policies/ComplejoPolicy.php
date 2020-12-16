<?php

namespace App\Policies;

use App\User;
use App\Complejo;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class ComplejoPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function view(User $user, Complejo $complejo)
    {

        return $user->hasRole('Admin') || $user->hasPermissionTo('View Complejo');
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create Complejo');
    }

    public function update(User $user, Complejo $complejo)
    {
        
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update Complejo');
    }

    public function delete(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete Complejo');
    }
}
