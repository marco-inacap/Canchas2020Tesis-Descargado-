<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        User::truncate(); // Evita duplicar datos

        $adminRole = Role::create(['name'=>'Admin','display_name'=> 'Administrador']);
        $dueñoRole = Role::create(['name'=>'Dueño','display_name' =>'Dueño de Complejo']);
        $clienteRole = Role::create(['name'=>'Cliente','display_name' =>'Cliente de Pagina']);

        $viewCanchaPermission   = Permission::create(['name'=>'View Cancha','display_name' => 'Ver Cancha']);
        $createCanchaPermission = Permission::create(['name'=>'Create Cancha','display_name' => 'Crear Cancha']);
        $updateCanchaPermission = Permission::create(['name'=>'Update Cancha','display_name' => 'Editar Cancha']);
        $deleteCanchaPermission = Permission::create(['name'=>'Delete Cancha','display_name' => 'Eliminar Cancha']);
        $arrendarCanchaPermission = Permission::create(['name'=>'Arrendar Cancha','display_name' => 'Arrendar una Cancha']);

        $viewUsersPermission   = Permission::create(['name'=>'View Users','display_name' => 'Ver Usuarios']);
        $createUsersPermission = Permission::create(['name'=>'Create Users','display_name' => 'Crear Usuarios']);
        $updateUsersPermission = Permission::create(['name'=>'Update Users','display_name' => 'Editar Usuarios']);
        $deleteUsersPermission = Permission::create(['name'=>'Delete Users','display_name' => 'Eliminar Usuarios']);

        $viewRolesPermission =   Permission::create(['name'=>'View Roles','display_name' => 'Ver Roles']);
        $createRolesPermission = Permission::create(['name'=>'Create Roles','display_name' => 'Crear Roles']);
        $updateRolesPermission = Permission::create(['name'=>'Update Roles','display_name' => 'Editar Roles']);
        $deleteRolesPermission = Permission::create(['name'=>'Delete Roles','display_name' => 'Eliminar Roles']);

        $viewPermissionsPermission =   Permission::create(['name'=>'View Permissions','display_name' => 'Ver Permisos']);
        $updatePermissionsPermission =   Permission::create(['name'=>'Update Permissions','display_name' => 'Editar Permisos']);
        
        $primerAccesoPermission =   Permission::create(['name'=>'Primer Acceso','display_name' => 'Acceso para ingresar']);

        $clienteRole->givePermissionTo($arrendarCanchaPermission);

        $admin = new User();
        $admin->name = "Marco";
        $admin->email = "marcoignacio.96@hotmail.com";
        $admin->password = 'mamasa20';
        $admin->save();
        $admin->assignRole($adminRole);

        $admin->givePermissionTo($viewCanchaPermission);
        $admin->givePermissionTo($createCanchaPermission);
        $admin->givePermissionTo($updateCanchaPermission);
        $admin->givePermissionTo($deleteCanchaPermission);

        $admin->givePermissionTo($viewUsersPermission);
        $admin->givePermissionTo($createUsersPermission);
        $admin->givePermissionTo($updateUsersPermission);
        $admin->givePermissionTo($deleteUsersPermission);

        $admin->givePermissionTo($viewRolesPermission);
        $admin->givePermissionTo($createRolesPermission);
        $admin->givePermissionTo($updateRolesPermission);
        $admin->givePermissionTo($deleteRolesPermission);

        $admin->givePermissionTo($viewPermissionsPermission);
        $admin->givePermissionTo($viewPermissionsPermission);

        $admin->givePermissionTo($arrendarCanchaPermission);
        $admin->givePermissionTo($primerAccesoPermission);

        
        $dueño = new User();
        $dueño->name = "Jorge";
        $dueño->email = "marcoignacio.9637@gmail.com";
        $dueño->password = 'mamasa20';
        $dueño->save();
        $dueño->assignRole($dueñoRole);
    }
}
