<?php

namespace Ridhima\MediaManager\Providers;

use Illuminate\Support\ServiceProvider;
// use Barryvdh\Elfinder\ElfinderServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;

class MediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerElfinderRoutes($router);
        
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'mediamanager');

        $this->publishes([__DIR__.'/../Resources/lang' => resource_path('lang/vendor/mediamanager')]);

        $this->publishes([
            __DIR__.'/../Config/elfinder.php' => config_path('elfinder.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'mediamanager');

        $this->publishes([
            __DIR__ . '/../../publishable/assets/css/style.css' => public_path('vendor/mediamanager/custom/style.css'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../publishable/assets/images' => public_path('vendor/mediamanager/custom/images'),
        ], 'public');

        Event::listen('bagisto.admin.layout.body.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('mediamanager::admin.mediamanager.layouts.script');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();

        $this->app->singleton('command.mediamanager.publish', function($app) {
            $publicPath = $app['path.public'];
            return new \Ridhima\MediaManager\Console\PublishCommand($app['files'], $publicPath);
        });

        $this->commands('command.mediamanager.publish');
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/elfinder.php', 'elfinder'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );
    }

    protected function registerElfinderRoutes($router)
    {
        if (!defined('ELFINDER_IMG_PARENT_URL')) {
            define('ELFINDER_IMG_PARENT_URL', $this->app['url']->asset('vendor/mediamanager'));
        }

        $config = $this->app['config']->get('elfinder.route', []);
        $config['namespace'] = 'Barryvdh\Elfinder';

        $router->group($config, function($router)
        {
            $router->get('/',  ['as' => 'elfinder.index', 'uses' =>'ElfinderController@showIndex']);
            $router->any('connector', ['as' => 'elfinder.connector', 'uses' => 'ElfinderController@showConnector']);
            $router->get('popup/{input_id}', ['as' => 'elfinder.popup', 'uses' => 'ElfinderController@showPopup']);
            $router->get('filepicker/{input_id}', ['as' => 'elfinder.filepicker', 'uses' => 'ElfinderController@showFilePicker']);
            $router->get('tinymce', ['as' => 'elfinder.tinymce', 'uses' => 'ElfinderController@showTinyMCE']);
            $router->get('tinymce4', ['as' => 'elfinder.tinymce4', 'uses' => 'ElfinderController@showTinyMCE4']);
            $router->get('tinymce5', ['as' => 'elfinder.tinymce5', 'uses' => 'ElfinderController@showTinyMCE5']);
            $router->get('ckeditor', ['as' => 'elfinder.ckeditor', 'uses' => 'ElfinderController@showCKeditor4']);
        });
    }
}