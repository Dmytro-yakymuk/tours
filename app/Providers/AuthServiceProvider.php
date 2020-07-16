<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\User;
use App\Specie;
use App\Role;
use App\Permission;


use App\Policies\SpeciePolicy;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Article' => 'App\Policies\ArticlePolicy',

        //::class надає повний путь до класа
        Specie::class => SpeciePolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate) {

        $this->registerPolicies($gate);

    }
}
