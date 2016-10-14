@if(!isset($_COOKIE['cookieconsent']) || $_COOKIE['cookieconsent'] !== 'yes')

<div class="cookieconsent">
    <div class="container">
        <div class="cookieconsent-text pull-left">
            {{ trans('cookieconsent::bar.description') }}
            <a href="{{ config('cookieconsent.link') }}" target="_blank">
                {{ trans('cookieconsent::bar.more') }}
            </a>
        </div>
        <button class="btn btn-sm btn-warning pull-right cookieconsent-close">OK</button>
    </div>
</div>

<script defer>
    document.addEventListener("DOMContentLoaded", function(event) {
        new Alpaca.Global.CookieConsent();
    });
</script>

@endif