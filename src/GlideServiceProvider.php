<?php

namespace Rojtjo\LumenGlide;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;
use League\Glide\Api\Api;
use League\Glide\Server;
use Rojtjo\Glide\Responses\LumenResponseFactory;

class GlideServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadDefaultConfig();
        $this->registerRoute();
    }

    /**
     * Load the default config.
     */
    public function loadDefaultConfig()
    {
        $defaults = require __DIR__.'/../config/glide.php';
        $config = config('glide', []);

        config([
            'glide' => array_merge($defaults, $config)
        ]);
    }

    /**
     * Register the default image route.
     */
    public function registerRoute()
    {
        $uri = config('glide.uri');
        $uri = sprintf('%s/{path:.*}', trim($uri, '/'));
        $this->app->get($uri, ImageController::class.'@show');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindIf('glide.source', function($app) {
            $source = config('glide.source');

            if (is_callable($source)) {
                return $source();
            }

            return $source;
        }, true);

        $this->app->bindIf('glide.cache', function($app) {
            $cache = config('glide.cache');

            if (is_callable($cache)) {
                return $cache();
            }

            return $cache;
        }, true);

        $this->app->bindIf('glide.manipulators', function($app) {
            $manipulators = config('glide.manipulators');

            if (is_callable($manipulators)) {
                return $manipulators();
            }

            return $manipulators;
        }, true);

        $this->app->bindIf('glide.image_manager', function($app) {
            $driver = config('glide.driver', 'gd');

            return new ImageManager([
                'driver' => $driver
            ]);
        }, true);

        $this->app->bindIf('glide.api', function($app) {
            $imageManager = $app['glide.image_manager'];
            $manipulators = $app['glide.manipulators'];

            return new Api(
                $imageManager,
                $manipulators
            );
        }, true);

        $this->app->bindIf('glide.server', function($app) {
            $source = $app['glide.source'];
            $cache = $app['glide.cache'];
            $api = $app['glide.api'];

            $server = new Server(
                $source,
                $cache,
                $api
            );

            $request = $app['request'];

            $server->setResponseFactory(new LumenResponseFactory(
                $request
            ));

            return $server;
        }, true);

        $this->app->alias('glide.image_manager', ImageManager::class);
        $this->app->alias('glide.api', Api::class);
        $this->app->alias('glide.server', Server::class);
    }
}
