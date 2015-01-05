<?php namespace Tech\Bracket;

use Illuminate\Support\ServiceProvider;

class BracketServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$app = $this->app;
		$this->package('tech/bracket','techvikky');
		require __DIR__.'/../../macros.php';
		$this->app['router']->resource('menus','Tech\Controller\MenuController');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
