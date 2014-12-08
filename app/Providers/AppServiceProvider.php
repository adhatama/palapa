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

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Repositories\Cause\RepositoryInterface', 'App\Repositories\Cause\DummyCaseRepository');
		$this->app->bind('App\Officer\RepositoryInterface', 'App\Officer\EloquentRepository');
		$this->app->bind('App\Lookup\RepositoryInterface', 'App\Lookup\EloquentRepository');
		$this->app->bind('App\Cases\RepositoryInterface', 'App\Cases\EloquentRepository');
	}

}
