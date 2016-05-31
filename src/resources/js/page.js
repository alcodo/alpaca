$(function () {
    function getSlug(val) {
        val = val.toLowerCase();
        val = val.replace(/ /g, '-');
        return val.replace(/ä/g, "ae").replace(/ö/g, "oe").replace(/ü/g, "ue").replace(/Ä/g, "Ae").replace(/Ö/g, "Oe").replace(/Ü/g, "Ue").replace(/ß/g, "ss");
    }

    $(".is-title").keyup(function () {
        var val = $(this).val();
        val = getSlug(val);
        val = '/' + val;

        $(".is-path").val(val);
    });

    $(".is-title-to-slug").keyup(function () {
        var val = $(this).val();
        val = getSlug(val);

        $(".is-slug").val(val);
    });
});