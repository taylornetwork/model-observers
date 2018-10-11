# Model Observers

This package will automatically make sure that all models that have an observer are booted via `Model::observe(Observer::class)`

The service provider will look for models with a matching observer class in the observer namespace that follow the naming convention:

|Model Class Name|Observer Class Name|
|:--|:--|
| Example | ExampleObserver |

See [Laravel's Observer Documentation](https://laravel.com/docs/master/eloquent#observers)

## Install

Via Composer

```bash
$ composer require taylornetwork/model-observers
```

## Publish Config

```bash
$ php artisan vendor:publish --provider="TaylorNetwork\ModelObservers\ModelObserverServiceProvider"
```

Will publish `config/model-observers.php`

## Config

If you keep your models under a different namespace than `App` you will need to change the `model_namespace` key in `config/model-observers.php` 

## Create an Observer

To create an observer, you can use Laravel's built-in `make:observer` command.

See [Laravel's Observer Documentation](https://laravel.com/docs/master/eloquent#observers)

*Note: this package will register the newly created observer automatically*