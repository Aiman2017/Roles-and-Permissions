<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
//        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        foreach (config('permissions') as $keys => $labels) {
            foreach ($labels as $code => $label) {
                Gate::define($code, function ($user) use ($code) {
                    $abilities = $user->roles()->with('abilities')->get()->pluck('abilities.*.ability')->flatten()->unique()->toArray();
                    if (in_array($code, $abilities)) {
                        return true;
                    }
//                    $roles = $user->roles()->with('abilities')->get()->toArray();
//                    foreach ($roles as $role) {
//                        foreach ($role['abilities'] as $ability) {
//                            if (in_array($code, $ability['ability'])) {
//                                return true;
//                            }
//                        }
//                    }
                    return false;
                });
            }
        }
        $this->registerPolicies();
    }
}
