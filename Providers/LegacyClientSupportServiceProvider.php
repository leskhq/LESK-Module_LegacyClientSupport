<?php
namespace App\Modules\LegacyClientSupport\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class LegacyClientSupportServiceProvider extends ServiceProvider
{
	/**
	 * Register the LegacyClientSupport module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\LegacyClientSupport\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the LegacyClientSupport module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('legacy_client_support', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('legacy_client_support', base_path('resources/views/vendor/legacy_client_support'));
		View::addNamespace('legacy_client_support', realpath(__DIR__.'/../Resources/Views'));
	}

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
		// $this->addMiddleware('');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('legacy_client_support.php'),
        ], 'config');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'legacy_client_support'
        );
    }

	/**
     * Register the Middleware
     *
     * @param  string $middleware
     */
	protected function addMiddleware($middleware)
	{
		$kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware($middleware);
	}
}
