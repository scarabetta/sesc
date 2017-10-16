<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        \URL::forceRootUrl(\Config::get('app.url'));    
        // And this if you wanna handle https URL scheme
        // It's not usefull for http://www.example.com, it's just to make it more independant from the constant value
        if (str_contains(\Config::get('app.url'), 'https://')) {
            #\URL::forceScheme('https'); // laravel >= 5.4
            \URL::forceSchema('https'); // laravel < 5.4
        }
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
