<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Request;

function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

function isActiveUrl($path, $output = 'active')
{
    if ($path !== '/') {
        // not a frontpage
        $path = trim($path, '/');
    }

    if ($path === Request::path()) {
        return $output;
    }
}

if (! function_exists('alpacaFactory')) {
    /**
     * Create a model factory builder for a given class, name, and amount.
     *
     * @param  dynamic  class|class,name|class,amount|class,name,amount
     * @return \Illuminate\Database\Eloquent\FactoryBuilder
     */
    function alpacaFactory()
    {
        $factory = Factory::construct(app('Faker\Generator'), base_path('/alpaca/src/resources/factories/'));

        $arguments = func_get_args();

        if (isset($arguments[1]) && is_string($arguments[1])) {
            return $factory->of($arguments[0], $arguments[1])->times(isset($arguments[2]) ? $arguments[2] : 1);
        } elseif (isset($arguments[1])) {
            return $factory->of($arguments[0])->times($arguments[1]);
        } else {
            return $factory->of($arguments[0]);
        }
    }
}
