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
        setlocale(LC_TIME, 'id_ID');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Cases\RepositoryInterface', 'App\Cases\EloquentRepository');
		$this->app->bind('App\Officer\RepositoryInterface', 'App\Officer\EloquentRepository');
		$this->app->bind('App\Lookup\RepositoryInterface', 'App\Lookup\EloquentRepository');
		$this->app->bind('App\Cases\RepositoryInterface', 'App\Cases\EloquentRepository');
		$this->app->bind('App\Sop\RepositoryInterface', 'App\Sop\EloquentRepository');

		\View::addNamespace('dekor', base_path('vendor/eendonesia/dekor/src/views/'));
		\View::addNamespace('gapura', base_path('vendor/eendonesia/gapura/src/views/'));
		\View::addNamespace('skrip', base_path('vendor/eendonesia/skrip/src/views/'));

		\Config::set('gapura::default_auth', 'frontend.search');
		\Config::set('gapura::default_guest', 'frontend.search');
		\Config::set('gapura::base_uri', 'gapura');

		\Config::set('skrip::prefix', 'skrip');

	}

}
