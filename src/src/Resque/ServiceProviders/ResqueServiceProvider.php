<?php namespace Resque\ServiceProviders;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Resque\Connectors\ResqueConnector;
use Resque\Console\ListenCommand;

/**
 * Class ResqueServiceProvider
 *
 * @package Resque\ServiceProviders
 */
class ResqueServiceProvider extends ServiceProvider {

	/**
	 * {@inheritdoc}
	 */
	public function boot()
	{
		$this->registerResqueConnector($this->app['queue']);
	}

	/**
	 * Register the Resque queue connector.
	 *
	 * @param \Illuminate\Queue\QueueManager $manager
	 * @return void
	 */
	protected function registerResqueConnector($manager)
	{
		$manager->addConnector('resque', function ()
		{
			$config = config('database.redis.default');
			config(['queue.connections.resque' => array_merge($config, ['driver' => 'resque'])]);

			return new ResqueConnector;
		});
	}

	/**
	 * Registers the artisan command.
	 *
	 * @return void
	 */
	protected function registerCommand()
	{
		$this->app->singleton('command.resque.listen', function () {
			return new ListenCommand;
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommand();
	}
} // End ResqueServiceProvider
