<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        //自訂Token 過期時間

        //access_token
        Passport::tokensExpireIn(now()->addDays(15));
        //refresh_token
        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::tokensCan([
            'create-animals'=>'建立動物資訊',
            'user-info'=>'使用者資訊'
        ]);
    }
}
