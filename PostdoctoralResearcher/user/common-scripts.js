$(function () {
    $("#nav-accordion").dcAccordion({
        eventType: "click",
        autoClose: !0,
        saveState: !0,
        disableLink: !0,
        speed: "slow",
        showCount: !1,
        autoExpand: !0,
        classExpand: "dcjq-current-parent"
    })
});
var Script = function () {
    jQuery("#sidebar .sub-menu > a").click(function () {
        var n = $(this).offset();
        diff = 250 - n.top;
        diff > 0 ? $("#sidebar").scrollTo("-=" + Math.abs(diff), 500) : $("#sidebar").scrollTo("+=" + Math.abs(diff), 500)
    });
    $(function () {
        function n() {
            var n = $(window).width();
            n <= 768 && ($("#container").addClass("sidebar-close"), $("#sidebar > ul").hide());
            n > 768 && ($("#container").removeClass("sidebar-close"), $("#sidebar > ul").show())
        }
        $(window).on("load", n);
        $(window).on("resize", n)
    });
    $(".icon-reorder").click(function () {
        $("#sidebar > ul").is(":visible") === !0 ? ($("#main-content").css({
            "margin-right": "0px"
        }), $("#sidebar").css({
            "margin-right": "-210px"
        }), $("#sidebar > ul").hide(), $("#container").addClass("sidebar-closed")) : ($("#main-content").css({
            "margin-right": "210px"
        }), $("#sidebar > ul").show(), $("#sidebar").css({
            "margin-right": "0"
        }), $("#container").removeClass("sidebar-closed"))
    });
    $("#sidebar").niceScroll({
        styler: "fb",
        cursorcolor: "#f2956d",
        cursorwidth: "3",
        cursorborderradius: "10px",
        background: "#007785",
        spacebarenabled: !1,
        cursorborder: ""
    });
    $("html").niceScroll({
        styler: "fb",
        cursorcolor: "#f2956d",
        cursorwidth: "6",
        cursorborderradius: "10px",
        background: "#007785",
        spacebarenabled: !1,
        cursorborder: "",
        zindex: "1000"
    });

    jQuery(".panel .tools .icon-chevron-down").click(function () {
        var n = jQuery(this).parents(".panel").children(".panel-body");
        jQuery(this).hasClass("icon-chevron-down") ? (jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up"), n.slideUp(200)) : (jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down"), n.slideDown(200))
    });
    jQuery(".panel .tools .icon-remove").click(function () {
        jQuery(this).parents(".panel").parent().remove()
    });
    $(".tooltips").tooltip();
    $(".popovers").popover()
}()