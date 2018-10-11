<?php 

namespace TaylorNetwork\ModelObservers;

use Illuminate\Support\ServiceProvider;

class ModelObserverServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/model-observers.php', 'model-observers');

        $this->publishes([
            __DIR__.'/config/model-observers.php' => config_path('model-observers.php'),
        ]);

        $observerNamespace = config('model-observers.observer_namespace', 'App\\Observers');
        $modelNamespace = config('model-observers.model_namespace', 'App');

        if(last(str_split($observerNamespace)) !== '\\') {
        	$observerNamespace .= '\\';
        }

        if(last(str_split($modelNamespace)) !== '\\') {
        	$modelNamespace .= '\\';
        }

        $modelsPath = str_replace('App', 'app', str_replace('\\', '/', $modelNamespace));

        foreach(glob(base_path($modelsPath.'*.php')) as $model) {
            $modelName = explode('.', last(explode('/', $model)))[0];
            $model = $modelNamespace.$modelName;
            $observer = $observerNamespace.$modelName.'Observer';
            if(class_exists($observer)) {
                $model::observe($observer);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}	