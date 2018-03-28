<?php

namespace Alpaca\Support\Captcha;

use Symfony\Component\HttpFoundation\Request;

class CaptchaBuilder
{

    private $publicKey;
    private $secretKey;

    public function __construct($publicKey, $secretKey)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
    }


    public function renderJs()
    {
        $langCode = app()->getLocale();

        return "<script src=\"https://www.google.com/recaptcha/api.js?hl=$langCode\" async defer></script>";
    }

    public function renderInput()
    {
        return "<div class=\"g-recaptcha\" data-sitekey=\"$this->publicKey\"></div>";
    }

    public function verify(Request $request)
    {
        if (!$request->has('g-recaptcha-response')) {
            return false;
        }

        // request
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $this->secretKey,
                'response' => $request->get('g-recaptcha-response'),
                'remoteip' => $request->getClientIp(),
            ],
        ]);
        $response = json_decode($response->getBody(), true);

        // check
        if (!isset($response['success']) || $response['success'] !== true) {
            return false;
        }

        return true;
    }

}