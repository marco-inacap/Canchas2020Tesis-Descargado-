<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
        'App\Cancha' => 'App\Policies\CanchaPolicy',
        'App\Complejo' => 'App\Policies\ComplejoPolicy',
        'App\Horario' => 'App\Policies\HorarioPolicy',
        'Spatie\Permission\Models\Role'=> 'App\Policies\RolePolicy',
        'Spatie\Permission\Models\Permission'=> 'App\Policies\PermissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
