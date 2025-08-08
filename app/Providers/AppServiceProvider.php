<?php

namespace App\Providers;

use App\Policies\PremmisionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('viewAny', [PremmisionPolicy::class, 'viewAny']);
        Gate::define('acceptJob', [PremmisionPolicy::class, 'acceptJob']);
        Gate::define('Craete_Job', [PremmisionPolicy::class, 'create']);
        Gate::define('Update_Job', [PremmisionPolicy::class, 'update']);
        Gate::define('Delete_Job', [PremmisionPolicy::class, 'delete']);
    }
}
