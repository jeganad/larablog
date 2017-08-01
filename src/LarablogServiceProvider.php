<?php

namespace Naoray\Larablog;

use Naoray\Larablog\Models\Post;
use Illuminate\Support\ServiceProvider;
use Naoray\Larablog\Commands\PublishRessources;
use Naoray\Larablog\Contracts\Post as PostContract;

class LarablogServiceProvider extends ServiceProvider
{
    /**
     * Holds all packages which are used inside of larablog.
     *
     * @var array
     */
    protected $packageProviders = [
        'Spatie\MediaLibrary\MediaLibraryServiceProvider',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(PermissionRegistrar $permissionLoader)
    {
        $this->makeLarablogRessourcesAccessible();
        
        $this->app->bind(PostContract::class, Post::class);

        if (config('larablog.load_permissions')) {
            $permissionLoader->registerPermissions();
        }

        setlocale(LC_TIME, config('larablog.locale_time_setting'));
        config(['larablog.providers' => $this->packageProviders]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->packageProviders as $package) {
            $this->app->register($package);
        }

        $this->mergeConfigFrom(__DIR__.'/../config/larablog.php', 'larablog');
    }

    /**
     * Publishes all ressources needed for larablog package. Such ressources
     * include loading routes, config, assets, views, migrations and commands.
     */
    public function makeLarablogRessourcesAccessible()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishRessources::class
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/larablog.php' => config_path('larablog.php'),
        ], 'config');

        $this->publishes([
            base_path('vendor/'.config('larablog.theme').'/public') => public_path('vendor/larablog'),
        ], 'public');

        $this->loadViewsFrom(
            base_path('vendor/'.config('larablog.theme').'/resources/views'), 'larablog'
        );

        $this->publishes([
            base_path('vendor/'.config('larablog.theme').'/resources/views') => resource_path('views/vendor/larablog'),
        ], 'views');

        if (! class_exists('CreatePostsTable')) {
            $timestamp = date('Y_m_d_His', time());
            
            $this->publishes([
                __DIR__.'/../database/migrations/create_posts_table.php.stub' => $this->app->databasePath().'/migrations/'.$timestamp.'_create_posts_table.php',
            ], 'migrations');
        }
    }
}
