<?php
namespace Nocarefre\Spider;

use Illuminate\Auth\Events\Logout;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class SpiderServiceProvider extends ServiceProvider{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart', 'Gloudemans\Shoppingcart\Cart');
        $config = __DIR__ . '/../config/spider.php';
        $this->mergeConfigFrom($config, 'spider');
        $this->publishes([__DIR__ . '/../config/cart.php' => config_path('cart.php')], 'config');

        if ( ! class_exists('CreateSpiderLogTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/0000_00_00_000000_create_spider_log_table.php' => database_path('migrations/'.$timestamp.'_create_shoppingcart_table.php'),
            ], 'migrations');
        }
    }	
}