@if(!isset($_COOKIE['cookieconsent']) || $_COOKIE['cookieconsent'] !== 'yes')

<div class="cookieconsent">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-xs-10">
                {{ trans('cookieconsent::bar.description') }}
                <a href="{{ config('cookieconsent.link') }}" target="_blank">
                    {{ trans('cookieconsent::bar.more') }}
                </a>
            </div>
            <div class="col-sm-1 col-xs-2">
                <button class="btn btn-sm btn-warning pull-right cookieconsent-close">OK</button>
            </div>
        </div>
        {{--<div class="cookieconsent-text pull-left">--}}
            {{--{{ trans('cookieconsent::bar.description') }}--}}
            {{--<a href="{{ config('cookieconsent.link') }}" target="_blank">--}}
                {{--{{ trans('cookieconsent::bar.more') }}--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<button class="btn btn-sm btn-warning pull-right cookieconsent-close">OK</button>--}}
    </div>
</div>

<script defer>
    document.addEventListener("DOMContentLoaded", function(event) {
        new Alpaca.Global.CookieConsent();
    });
</script>

@endif