export default class CookieConsent {

    constructor() {
        var cookieConseetCloseButton = document.getElementsByClassName("cookieconsent-close");

        this.setCookieConsent = this.setCookieConsent.bind(this);
        cookieConseetCloseButton[0].addEventListener('click', this.setCookieConsent);

    }

    setCookieConsent() {

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

        // hide
        $('.cookieconsent').hide();

    }
}