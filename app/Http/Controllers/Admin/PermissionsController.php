<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission; 
use App\Providers\AuthServiceProviderGate\Gate;

class PermissionsController extends Controller
{
    public function index()
    {
        /* $this->authorize('view', Permission::class); */
          $this->authorize('view', new Permission);   

        return view('admin.permissions.index',[

            'permissions' => Permission::all(),

        ]);
    }
    public function edit(Permission $permission)
    {
        $this->authorize('update',$permission);   

        return view('admin.permissions.edit',[

            'permission' => $permission
        ]); 

    }
    public function update(Request $request, Permission $permission)
    {
         $this->authorize('update',$permission);   

        $data = $request->validate(['display_name' => 'required']);

        $permission->update($data);

        return redirect()->route('admin.permissions.edit', $permission)->withFlash('El Permiso fue actualizado exitosamente');

    }

}
