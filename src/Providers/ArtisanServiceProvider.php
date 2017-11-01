<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ArtisanServiceProvider extends ServiceProvider
{
	/**
	 * The commands to be registered.
	 *
	 * command[] or
	 * key => command class or register command method
	 *
	 * @var array
	 */
	protected $commands = [];

	/**
	 * Then you need to have the artisan commands all the time the app gets in action you have to change the value of this attribute
	 *
	 * @var bool
	 */
	protected $registerOnlyForConsole = true;

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->registerOnlyForConsole && !$this->app->runningInConsole()) {
			return;
		}

		$this->registerCommands($this->commands);
	}

	/**
	 * registers an array of commands (key is shortname and value is command class
	 * or part of the registerYYYCommand method name)
	 *
	 * @param array $commands
	 *
	 * @throws \Exception
	 */
	protected function registerCommands(array $commands)
	{
		if (!$this->app->runningInConsole()) {
			return;
		}

		foreach ($commands as $key => $command) {
			if (is_numeric($key)) {
				$key = Str::lower(str_replace("\\", '.', $command));
			}

			$method = "register{$command}";

			try {
				if (method_exists($this, $method)) {
					call_user_func_array([$this, $method], [$key]);
				} else {
					$this->app->singleton($key, function ($app) use ($command) {
						return $app->make($command);
					});
				}
				$this->commands($key);
			} catch (\Exception $e) {
				throw $e;
			}
		}
	}
}