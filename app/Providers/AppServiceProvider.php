<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\EmployeeClass;
use App\Repositories\EmployeeRepository;

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
        //for a more complicated application, would separate this to another provider
        //can swap out employee class for another class with different methods for a different storage solution
        $this->app->bind(EmployeeRepository::class, EmployeeClass::class);

    }
}
