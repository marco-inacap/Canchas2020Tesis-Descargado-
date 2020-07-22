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

        $viewComplejoPermission   = Permission::create(['name'=>'View Complejo','display_name' => 'Ver Complejo']);
        $createComplejoPermission = Permission::create(['name'=>'Create Complejo','display_name' => 'Crear Complejo']);
        $updateComplejoPermission = Permission::create(['name'=>'Update Complejo','display_name' => 'Editar Complejo']);
        $deleteComplejoPermission = Permission::create(['name'=>'Delete Complejo','display_name' => 'Eliminar Complejo']);

        $viewHorarioPermission   = Permission::create(['name'=>'View Horario','display_name' => 'Ver Horario']);
        $createHorarioPermission = Permission::create(['name'=>'Create Horario','display_name' => 'Crear Horario']);
        $updateHorarioPermission = Permission::create(['name'=>'Update Horario','display_name' => 'Editar Horario']);
        $deleteHorarioPermission = Permission::create(['name'=>'Delete Horario','display_name' => 'Eliminar Horario']);
        
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

        $admin->givePermissionTo($viewComplejoPermission);
        $admin->givePermissionTo($createComplejoPermission);
        $admin->givePermissionTo($updateComplejoPermission);
        $admin->givePermissionTo($deleteComplejoPermission);

        $admin->givePermissionTo($viewHorarioPermission);
        $admin->givePermissionTo($createHorarioPermission);
        $admin->givePermissionTo($updateHorarioPermission);
        $admin->givePermissionTo($deleteHorarioPermission);

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
