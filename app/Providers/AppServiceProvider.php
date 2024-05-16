<?php

namespace App\Providers;

use App\Repositories\V1\PatientRepository;
use App\Repositories\V1\PatientRepositoryInterface;
use App\Services\V1\PatientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(PatientService::class, function ($app) {
            return new PatientService($app->make(PatientRepositoryInterface::class));
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
