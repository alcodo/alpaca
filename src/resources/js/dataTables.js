$(document).ready(function () {

    var lang = $(".is-datatables").data("lang"),
        settings;

    if (lang) {

        if (lang != "en") {
            // use not default language
            settings = {
                "language": dataTables_languages[lang]
            };
        }

        $(".is-datatables").DataTable(settings);
    }
});