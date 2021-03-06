<?php

namespace Compasspointmedia\Julietmenu;

use Illuminate\Support\ServiceProvider;

class JulietmenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // loading the routes
        // require __DIR__ . "/Http/routes.php";
        // $configPath = __DIR__ . '/config/trickster.php';
        // $this->publishes([$configPath => config_path('trickster.php')]);
        // $this->mergeConfigFrom($configPath, 'trickster');

        // Registers Commands
        $this->commands('command.juliet.migration');
        $this->commands('command.juliet.menu');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Compasspointmedia\Julietmenu\Julietmenu');
        
        $this->registerCommands();
        
        $this->bindFacade();

    }

    private function bindFacade() {
        $this->app->bind('julietmenu', function($app) {
            return new Julietmenu();
        });
    }


    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.juliet.migration', function ($app) {
            return new MigrationCommand();
        });
        $this->app->singleton('command.juliet.menu', function () {
            return new MenuManagerCommand();
        });
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.juliet.migration',
            'command.juliet.menu',
        ];
    }
}
