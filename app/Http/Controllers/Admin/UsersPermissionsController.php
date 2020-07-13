<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);

        return back()->withFlash('Los Permisos han sido actualizados');
    }
}
