const MENU_TITLE = $('.menu-title'),
    SUBMENU_TITLE = $('.submenu-title')


$(".toggle-nav").click(function () {
    $('.nav-menu').css("left", "0px");
});
$(".mobile-back").click(function () {
    $('.nav-menu').css("left", "-410px");
});


$(".page-wrapper").attr("class", "page-wrapper " + localStorage.getItem("page-wrapper"));
$(".page-body-wrapper").attr("class", "page-body-wrapper " + localStorage.getItem("page-body-wrapper"));


if (localStorage.getItem("page-wrapper") === null) {
    $(".page-wrapper").addClass("compact-wrapper");
}

// left sidebar and horizotal menu
if ($('#pageWrapper').hasClass('compact-wrapper')) {
    SUBMENU_TITLE.append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    if ($('.submenu-title').hasClass('active')) {
        jQuery('.submenu-title.active').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
    } else {
        SUBMENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    }
    SUBMENU_TITLE.click(function () {
        SUBMENU_TITLE.removeClass('active');
        SUBMENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.submenu-content').slideUp('normal');
        if (jQuery(this).next().is(':hidden')) {
            jQuery(this).addClass('active');
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            jQuery(this).next().slideDown('normal');
        } else {
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        }
    });
    // jQuery('.submenu-content').hide();

    MENU_TITLE.append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    if (MENU_TITLE.hasClass('active')) {
        jQuery('.menu-title.active').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
    } else {
        MENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    }
    MENU_TITLE.click(function () {
        MENU_TITLE.removeClass('active');
        MENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.menu-content').slideUp('normal');
        if (jQuery(this).next().is(':hidden')) {
            jQuery(this).addClass('active');
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            jQuery(this).next().slideDown('normal');
        } else {
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        }
    });
    // jQuery('.menu-content').hide();
} else if ($('#pageWrapper').hasClass('horizontal-wrapper')) {
    let contentwidth = jQuery(window).width();
    if ((contentwidth) < '992') {
        $('#pageWrapper').removeClass('horizontal-wrapper').addClass('compact-wrapper');
        $('.page-body-wrapper').removeClass('horizontal-menu').addClass('sidebar-icon');
        SUBMENU_TITLE.append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        SUBMENU_TITLE.click(function () {
            SUBMENU_TITLE.removeClass('active');
            SUBMENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.submenu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden')) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.submenu-content').hide();

        MENU_TITLE.append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        MENU_TITLE.click(function () {
            MENU_TITLE.removeClass('active');
            MENU_TITLE.find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.menu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden')) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.menu-content').hide();
    }

}

/**------------------------------------------------------------------------------------------------------
 *                       =======================            TOGGLE SIDEBAR            ===
 *_______________________________________________________________________________________________________*/
$nav = $('.main-nav');
$header = $('.page-main-header');
$toggle_nav_top = $('#sidebar-toggle');

$body_part_side = $('.body-part');
$body_part_side.click(function () {
    $toggle_nav_top.attr('checked', false);
    $nav.addClass('close_icon');
    $header.addClass('close_icon');
});

// document sidebar
$('.mobile-sidebar').click(function () {
    $('.document').toggleClass('close')
});

//    responsive sidebar
let $window = $(window);
let widthwindow = $window.width();
(function ($) {
    "use strict";
    if (widthwindow + 17 <= 993) {
        $toggle_nav_top.attr('checked', false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    }
})(jQuery);
$(window).resize(function () {
    let widthwindaw = $window.width();
    if (widthwindaw + 17 <= 991) {
        $toggle_nav_top.attr('checked', false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    } else {
        $toggle_nav_top.attr('checked', true);
        $nav.removeClass("close_icon");
        $header.removeClass("close_icon");
    }
});

// horizontal arrowss
let view = $("#mainnav");
let move = "500px";
let leftsideLimit = -500

// let Windowwidth = jQuery(window).width();
// get wrapper width
let getMenuWrapperSize = function () {
    return $('.sidebar-wrapper').innerWidth();
}
let menuWrapperSize = getMenuWrapperSize();

if ((menuWrapperSize) >= '1660') {
    let sliderLimit = -3000

} else if ((menuWrapperSize) >= '1440') {
    let sliderLimit = -3600
} else {
    let sliderLimit = -4200
}

$("#left-arrow").addClass("disabled");
$("#right-arrow").click(function () {
    let currentPosition = parseInt(view.css("marginLeft"));
    if (currentPosition >= sliderLimit) {
        $("#left-arrow").removeClass("disabled");
        view.stop(false, true).animate({
            marginLeft: "-=" + move
        }, {
            duration: 400
        })
        if (currentPosition === sliderLimit) {
            $(this).addClass("disabled");
            console.log("sliderLimit", sliderLimit);
        }
    }
});

$("#left-arrow").click(function () {
    let currentPosition = parseInt(view.css("marginLeft"));
    if (currentPosition < 0) {
        view.stop(false, true).animate({
            marginLeft: "+=" + move
        }, {
            duration: 400
        })
        $("#right-arrow").removeClass("disabled");
        $("#left-arrow").removeClass("disabled");
        if (currentPosition >= leftsideLimit) {
            $(this).addClass("disabled");
        }
    }

});

// page active
// $( ".main-navbar" ).find( "a" ).removeClass("active");
// $( ".main-navbar" ).find( "li" ).removeClass("active");

let current = window.location.pathname
$(".main-navbar ul>li a").filter(function () {

    let link = $(this).attr("href");
    if (link) {
        if (current.indexOf(link) !== -1) {
            $(this).parents().children('a').addClass('active');
            $(this).parents().parents().children('ul').css('display', 'block');
            $(this).addClass('active');
            $(this).parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            $(this).parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            return false;
        }
    }
});
$('.custom-scrollbar').animate({
    scrollTop: $('a.nav-link.menu-title.active').offset().top - 500
}, 1000);
