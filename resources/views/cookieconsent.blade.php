@if(!isset($_COOKIE['cookieconsent']) || $_COOKIE['cookieconsent'] !== 'yes')

    <nav id="cookieconsent" v-if="showCookieConsent" class="navbar fixed-bottom navbar-light bg-light">
        <div class="container">
            <div class="col-sm-11 col-xs-10">
                {{ trans('alpaca::cookieconsent.description') }}
                <a href="/imprint" target="_blank">
                    {{ trans('alpaca::cookieconsent.more') }}
                </a>
            </div>
            <div class="col-sm-1 col-xs-2">
                <button class="btn btn-sm btn-warning pull-right cookieconsent-close" @click="acceptCookieConsent">OK
                </button>
            </div>
        </div>
    </nav>

    <script defer>

        new Vue({
            el: '#cookieconsent',
            data: {
                showCookieConsent: true,
            },
            methods: {
                acceptCookieConsent: function () {
                    this.setCookie();
                    this.showCookieConsent = false;
                },
                setCookie: function () {
                    // Resolve top domain
                    var parsed_host = document.location.hostname.split('.').reverse();
                    var domain = parsed_host[1] + '.' + parsed_host[0];

                    // Expiration date
                    var expDuration = 365 * 24 * 60 * 60 * 1000;
                    var expDate = new Date();
                    expDate.setTime(expDate.getTime() + expDuration);

                    // Cookie string
                    var cookieString = "";
                    cookieString += "cookieconsent=yes; ";
                    cookieString += "expires=" + expDate.toGMTString() + "; "
                    cookieString += "domain=" + domain + "; ";
                    cookieString += "path=/";

                    document.cookie = cookieString;
                },
            }
        });

    </script>

@endif