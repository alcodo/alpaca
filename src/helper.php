<?php

/**
 * If route is active than the css class will printed.
 * @param $route
 * @param string $output
 * @return string
 */
function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

function isActiveUrlExact($exactPath, $output = 'active')
{
    if (\Illuminate\Support\Facades\Request::getPathInfo() == $exactPath) {
        return $output;
    }
}

function isActiveUrl($similarPath, $output = 'active')
{
    $actualPath = \Illuminate\Support\Facades\Request::getPathInfo();

    if (strpos($actualPath, $similarPath) !== false) {
        return $output;
    }
}

//function removeFirstSlash($path)
//{
//    // frontpage except rule
//    if ($path == '/') {
//        return $path;
//    }
//
//    // remove first slash
//    if ($path[0] == '/') {
//        return trim($path, '/');;
//    }
//
//    return $path;
//}

//if (! function_exists('alpacaFactory')) {
//    /**
//     * Create a model factory builder for a given class, name, and amount.
//     *
//     * @param  dynamic  class|class,name|class,amount|class,name,amount
//     * @return \Illuminate\Database\Eloquent\FactoryBuilder
//     */
//    function alpacaFactory()
//    {
//        $factory = \Illuminate\Database\Eloquent\Factory::construct(app('Faker\Generator'), base_path('vendor/alcodo/alpaca/src/resources/factories/'));
//
//        $arguments = func_get_args();
//
//        if (isset($arguments[1]) && is_string($arguments[1])) {
//            return $factory->of($arguments[0], $arguments[1])->times(isset($arguments[2]) ? $arguments[2] : 1);
//        } elseif (isset($arguments[1])) {
//            return $factory->of($arguments[0])->times($arguments[1]);
//        } else {
//            return $factory->of($arguments[0]);
//        }
//    }
//}
