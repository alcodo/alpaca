$(".is-sidebar-left").on("click", function (e) {
    e.preventDefault();
    $('body').toggleClass("body-left");
    $('.sidebar-left').toggleClass("active");
});