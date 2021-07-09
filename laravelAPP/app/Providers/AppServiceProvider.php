<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\User;
use App\Models\WorkLog;
use App\Observers\EmployeeObserver;
use App\Observers\UserObserver;
use App\Observers\WorkLogObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Employee::observe(EmployeeObserver::class);
        WorkLog::observe(WorkLogObserver::class);
    }
}
