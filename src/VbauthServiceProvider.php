<?php namespace Posttwo\Vbauth;
 
use Illuminate\Support\ServiceProvider;
 
class VbauthServiceProvider extends ServiceProvider {
 
	/**
	* Bootstrap the application services.
	*
	* @return void
	*/
	public function boot()
	{
		$this->publishes([__DIR__.'/config/vbauth.php' => config_path('vbauth.php')]);
	}
	 
	/**
	* Register the application services.
	*
	* @return void
	*/
	public function register()
	{
		$this->app->make('Posttwo\Vbauth\Vbauth');
	}
 
}
