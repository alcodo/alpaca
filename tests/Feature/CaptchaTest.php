<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Illuminate\Http\Request;
use Alpaca\Support\Captcha\CaptchaBuilder;

class CaptchaTest extends IntegrationTest
{
    public function testRender()
    {
        $captcha = new CaptchaBuilder('a', 'b');
        $this->assertEquals('<script src="https://www.google.com/recaptcha/api.js&hl=en" async defer></script>', $captcha->renderJs());
        $this->assertEquals('<div class="g-recaptcha" data-sitekey="a"></div>', $captcha->renderInput());
    }

    public function testFaildRequest()
    {
        $captcha = new CaptchaBuilder('a', 'b');
        $isSuccessful = $captcha->verify(new Request());

        $this->assertFalse($isSuccessful);
    }
}
