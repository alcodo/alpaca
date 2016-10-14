@if(!isset($_COOKIE['cnc_cookie_consent']) || $_COOKIE['cnc_cookie_consent'] !== 'yes'))

<div class="cookie-consent">
    <div class="container">
        <div class="cookie-consent-text pull-left">
            {{ trans('global.cookie_consent') }}
            <a href="{{ trans('routes.disclaimer') }}" target="_blank">{{ trans('global.more') }}</a>
        </div>
        <button class="btn btn-default pull-right cookie-consent-close">OK</button>
    </div>
</div>

@endif