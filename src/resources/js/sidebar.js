// var body = document.body,
//     html = document.documentElement;
//
// var height = Math.max( body.scrollHeight, body.offsetHeight,
//     html.clientHeight, html.scrollHeight, html.offsetHeight );
// //
// // console.log(height);
// // var height = $('#site-wrapper').height();
// $('#site-wrapper').height(height);
//
// console.log(height);
//
// 1013 -1064


/**
 * Left
 */
$(".is-sidebar-left").on("click", function (e) {
    toggleSidebarLeft();
    return false;
});

$( "body" ).on( "click", ".show-sidebar-left .overlay", function() {
    toggleSidebarLeft();
    return false;
});

// $(".show-sidebar-left .overlay").on("click", function (e) {
//     toggleSidebarLeft();
//     return false;
// });

function toggleSidebarLeft() {
    // var height = $('#site-wrapper').height();
    // $('#site-wrapper').height(height);
    // console.log($('#site-wrapper').height());
    $('#site-wrapper').toggleClass("show-sidebar-left");
    // console.log($('#site-wrapper').height());
    // $('#site-wrapper')
}

/**
 * Right
 */
$(".is-sidebar-right").on("click", function (e) {
    toggleSidebarRight();
    return false;
});

$( "body" ).on( "click", ".show-sidebar-right .overlay", function() {
    toggleSidebarRight();
    return false;
});

// $(".show-sidebar-right .overlay").on("click", function (e) {
//     toggleSidebarRight();
//     return false;
// });

function toggleSidebarRight() {
    $('#site-wrapper').toggleClass("show-sidebar-right");
}