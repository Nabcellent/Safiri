"use strict";

/* ------------------------------------------------------------------------------------------------------------ */
/*                              Config                                                                          */
/* ------------------------------------------------------------------------------------------------------------ */
const CONFIG = {
    isNavbarVerticalCollapsed: false,
    theme: 'light',
    isRTL: false,
    isFluid: false,
};
Object.keys(CONFIG).forEach(function (key) {
    if (localStorage.getItem(key) === null) {
        localStorage.setItem(key, CONFIG[key]);
    }
});

setTimeout(() => {
    if (JSON.parse(localStorage.getItem('isNavbarVerticalCollapsed'))) {
        $('.main-nav').addClass('close_icon')
        $('.page-main-header').addClass('close_icon')
        document.getElementsByClassName('main-nav')
    }

    if (localStorage.getItem('theme') === 'dark') {
        $('.mode i').toggleClass("fa-moon").toggleClass("fa-lightbulb");
        $('body').addClass('dark-only');
    }
}, 100)
