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

function isActiveUrl($similarPath, $output = 'active', $actualPath = null)
{
    if (is_null($actualPath)) {
        $actualPath = \Illuminate\Support\Facades\Request::getPathInfo();
    }

    if ($actualPath == '/') {
        return;
    }

    // convert both string are same length
    $lenghtActualPath = strlen($actualPath);
    $lenghtSimilarPath = strlen($similarPath);

    if ($lenghtActualPath > $lenghtSimilarPath) {
        $actualPath = substr($actualPath, 0, $lenghtSimilarPath);
    } elseif ($lenghtActualPath < $lenghtSimilarPath) {
        $similarPath = substr($similarPath, 0, $lenghtActualPath);
    }

    // check
    if ($actualPath === $similarPath) {
        return $output;
    }
}
