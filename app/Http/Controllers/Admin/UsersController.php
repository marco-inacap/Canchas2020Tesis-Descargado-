<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Cancha;
use App\Complejo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Events\UserWasCreated;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $users = User::allowed()->get();
        


        return view ('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         /* $this->authorize('create',$user);  */
        $this->authorize('create',new User);

        $user = new User;
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        $complejos = Complejo::all();

        return view('admin.users.create',compact('user','roles','permissions','complejos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', new User);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'complejos' => 'required',
        ]);

        $data['password'] = str_random(8);

        $user = User::create($data);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        UserWasCreated::dispatch($user, $data['password']);

        $user->complejo()->attach($request->get('complejos'));

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido creado');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Cancha $cancha)
    {
        $this->authorize('view',$user);

        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        $complejos = Complejo::all();

        return view('admin.users.edit',compact('user','roles','permissions','complejos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request,User $user)
    {
        
        $this->authorize('update',$user);

        $user->update($request->validated());
        $user->complejo()->sync($request->get('complejos'));

        return redirect()->route('admin.users.edit', $user)->withFlash('Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);

        $user->delete();
        
        return redirect()->route('admin.users.index')->with('flash','El Usuario ha sido eliminado');
    }
}
