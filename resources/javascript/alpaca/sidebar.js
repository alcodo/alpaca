/**
 * Left
 */
$(".is-sidebar-left").on("click", function (e) {
    $("body").toggleClass("modal-open-left");
    toggleSidebar($(".sidebar-left"));
    return false;
});

$( "html" ).on( "click", ".modal-open-left .overlay, .modal-open-left .sidebar-close", function() {
    $("body").toggleClass("modal-open-right");
    toggleSidebar($(".sidebar-left"));
    return false;
});

/**
 * Right
 */
$(".is-sidebar-right").on("click", function (e) {
    $("body").toggleClass("modal-open-right");
    toggleSidebar($(".sidebar-right"));
    return false;
});

$( "html" ).on( "click", ".modal-open-right .overlay, .modal-open-right .sidebar-close", function() {
    $("body").toggleClass("modal-open-right");
    toggleSidebar($(".sidebar-right"));
    return false;
});

/**
 * Functions
 */
function toggleSidebar(sidebar) {

    var sidebarOpen = $("body.modal-open").length > 0;

    if(sidebarOpen){
        closeSidebar(sidebar);
    }else{
        openSidebar(sidebar);
    }

}
function openSidebar(sidebar) {
    $("body").toggleClass("modal-open");

    sidebar.addClass("slideleft-enter");

    sidebar.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
        sidebar.removeClass("slideleft-enter");
    });

}

function closeSidebar(sidebar) {
    $("body").toggleClass("modal-open");

    sidebar.addClass("slideleft-leave");

    sidebar.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
        sidebar.removeClass("slideleft-leave");
    });
}