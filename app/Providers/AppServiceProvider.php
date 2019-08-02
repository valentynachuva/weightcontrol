<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repository\WeightRepositoryInterface;
use App\Repository\WeightRepository;

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
        $this->app->bind(
             \App\Repository\WeightRepositoryInterface::class,
             \App\Repository\WeightRepository::class
         );
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
