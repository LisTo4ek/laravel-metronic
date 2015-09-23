<?php namespace Listo4ek\Metronic;

use Illuminate\Support\ServiceProvider;
use View;

class MetronicServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'bootstrap_form');

        $this->app->bindShared('metronic', function($app) {
            return new Metronic();
        });
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
	    $this->loadViewsFrom(__DIR__.'/views', 'metronic');

//	    View::composer('metronic::layouts.layout4.sidebar', function($view) {
//		    $view->with('items', $items);
//	    });
//
//	    View::composer('metronic::layouts.layout4.sidebar', function($view) {
//		    $view->with('items', $items);
//	    });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['metronic'];
    }
}
