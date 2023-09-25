<?php

namespace App\Providers;

use App\Services\Interfaces\AuthInterface;
use App\Services\Interfaces\TwitListInterface;
use App\Services\Interfaces\UserInterface;
use App\Services\Repositories\AuthRepository;
use App\Services\Repositories\TwitListRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class ControllerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            AuthInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            TwitListInterface::class,
            TwitListRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
