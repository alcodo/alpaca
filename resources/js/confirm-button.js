$(function () {

    // confirm button
    $('[data-toggle="confirmation"]').confirmation({
        onConfirm: function (event, element) {
            $(event.currentTarget).parents('form:first').submit()
        }
    });

    // popup
    $('.is-popup').magnificPopup({type: 'image'});

    // summernote
    $('.is-summernote').summernote({
        lang: 'de-DE',
        height: 450
    });
    $('.is-summernote-small').summernote({
        lang: 'de-DE',
        height: 100
    });
});