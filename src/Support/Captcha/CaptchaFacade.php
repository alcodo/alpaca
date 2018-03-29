<?php

namespace Alpaca\Support\Captcha;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Captcha\CaptchaBuilder
 */
class CaptchaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'captcha';
    }
}
