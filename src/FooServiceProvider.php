<?php

namespace Foo;

use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Foo\Contracts\CarRepository::class,
            \Foo\Repositories\EloquentCarRepository::class
        );
    }
}
