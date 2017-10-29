<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;

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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
        if ( ! $this->app->runningInConsole()) {
            return;
        }

        $registeredCommands = [];
        foreach ($commands as $key => $command) {
            if (is_numeric($key)) {
                $key = $command;
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
                $registeredCommands[] = $key;
            } catch (\Exception $e) {
                throw $e;
            }
        }

        $this->commands($registeredCommands);
    }
}