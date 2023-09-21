<?php

namespace RichanFongdasen\GCRWorker;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as Provider;
use RichanFongdasen\GCRWorker\Console\Commands\ScheduleRunCommand;

class ServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            realpath(dirname(__DIR__).'/config/gcr-worker.php') => config_path('gcr-worker.php'),
        ], 'config');

        $this->mapRoutes();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $configPath = realpath(dirname(__DIR__).'/config/gcr-worker.php');

        if ($configPath !== false) {
            $this->mergeConfigFrom($configPath, 'gcr-worker');
        }

        $this->registerCommands();
    }

    /**
     * Register the package's console commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        $this->commands([
            ScheduleRunCommand::class,
        ]);
    }

    /**
     * Map the Pub/Sub event handler routes.
     */
    protected function mapRoutes(): void
    {
        $routeFile = realpath(dirname(__DIR__).'/routes/default.php');

        if ($routeFile !== false) {
            Route::prefix(config('gcr-worker.path_prefix'))
                ->name('gcr-worker.')
                ->namespace('RichanFongdasen\GCRWorker\Controllers')
                ->middleware(config('gcr-worker.middleware'))
                ->group($routeFile);
        }
    }
}
