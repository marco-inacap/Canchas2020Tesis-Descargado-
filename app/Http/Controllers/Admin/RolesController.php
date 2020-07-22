<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Role);  

        return view('admin.roles.index', [

            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Role);  
        

        return view('admin.roles.create', [

            'role'        => $role,
            'permissions' => Permission::pluck('name', 'id'),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->authorize('create', new Role);  

        $data = $request->validate(
            [

                'name'         => 'required | unique:roles',
                'display_name' => 'required',
                /* 'guard_name'   => 'required', */
            ],
            [
                'name.required' => 'El Nombre de Identificador es obligatorio.',
                'display_name.required' => 'El campo Nombre es obligatorio.'
            ]
        );

        $role = Role::create($data);

        if ($request->has('permissions')) {

            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.index')->withFlash('El Rol fue creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        $this->authorize('update', $role);  

        return view('admin.roles.edit', [

            'role'        => $role,
            'permissions' => Permission::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $this->authorize('update',$role);  
        /* return $request; */
        $data = $request->validate(
            [

                /* 'name' => 'required | unique:roles,name,' . $role->id, */
                'display_name' => 'required',
                /* 'guard_name' => 'required', */
            ],
            [
                'display_name.required' => 'El campo Nombre es obligatorio.'
            ]
        );

        $role->update($data);

        $role->permissions()->detach();

        if ($request->has('permissions')) {

            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.edit', $role)->withFlash('El Rol fue actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $this->authorize('delete', $role);  

        $role->delete();

        return redirect()->route('admin.roles.index')->with('flash', 'El Rol ha sido eliminado');
    }
}
