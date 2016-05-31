<?php

function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

//include __DIR__ . '/helper-dev.php';