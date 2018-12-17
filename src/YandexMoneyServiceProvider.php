<?php

namespace TkachevO\LaravelYandexMoney;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class YandexMoneyServiceProvider extends  ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     *  Bootstrap the application events.
     *
     */
    public function boot()
    {
        $config = realpath(__DIR__ . '/../config/yandexmoney.php');

        $this->publishes([
            $config => config_path('yandexmoney.php'),
        ], 'config');

        $this->mergeConfigFrom($config, 'yandexmoney');
    }

    /**
     * Register the service provider.
     *
     */
    public function register()
    {
        $this->app->singleton('yandexmoney', function (Container $app) {
            $config = $app['config'];
            return new YandexMoneyManager($config);
        });
    }

    public function provides()
    {
        return [
            'yandexmoney',
        ];
    }
}