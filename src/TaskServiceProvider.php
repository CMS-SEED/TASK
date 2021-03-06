<?php

namespace Cms_Framework_Seed\Task;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'task');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'task');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Call pblish redources function
        $this->publishResources();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'task');

        // Bind facade
        $this->app->bind('task', function ($app) {
            return $this->app->make('Cms_Framework_Seed\Task\Task');
        });

        // Bind Task to repository
        $this->app->bind(
            'Cms_Framework_Seed\Task\Interfaces\TaskRepositoryInterface',
            \Cms_Framework_Seed\Task\Repositories\Eloquent\TaskRepository::class
        );

        $this->app->register(\Cms_Framework_Seed\Task\Providers\AuthServiceProvider::class);
        $this->app->register(\Cms_Framework_Seed\Task\Providers\EventServiceProvider::class);
        $this->app->register(\Cms_Framework_Seed\Task\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['task'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('cms_framework_seed/task.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/task')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/../resources/lang' => base_path('resources/lang/vendor/task')], 'lang');

        // Publish public
        $this->publishes([__DIR__ . '/../public/' => public_path('/')], 'uploads');
    }
}
