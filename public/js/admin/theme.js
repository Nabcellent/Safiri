
/* ------------------------------------------------------------------------------------------------------------ */
/*                                    Utils                                                                     */
/* ------------------------------------------------------------------------------------------------------------ */
let docReady = function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fn);
    } else {
        setTimeout(fn, 1);
    }
};
let hasClass = function hasClass(el, className) {
    return el.classList.value.includes(className);
};
let getItemFromStore = function getItemFromStore(key, defaultValue) {
    let store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;

    try {
        return JSON.parse(store.getItem(key)) || defaultValue;
    } catch (_unused) {
        return store.getItem(key) || defaultValue;
    }
};
let setItemToStore = function setItemToStore(key, payload) {
    let store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
    return store.setItem(key, payload);
};
let utils = {
    docReady: docReady,
    getItemFromStore: getItemFromStore,
    setItemToStore: setItemToStore,
    hasClass: hasClass,
};



/* ------------------------------------------------------------------------------------------------------------ */
/*                               Navbar Vertical                                                                */
/* ------------------------------------------------------------------------------------------------------------ */
let handleNavbarVerticalCollapsed = function handleNavbarVerticalCollapsed() {
    let Selector = {
        NAV: '.main-nav',
        HEADER: '.page-main-header',
        NAVBAR_VERTICAL_TOGGLE: '#sidebar-toggle',
        NAVBAR_VERTICAL_COLLAPSE: '.main-nav .page-main-header',
    };
    let Events = {
        CLICK: 'click',
        NAVBAR_VERTICAL_TOGGLE: 'navbar.vertical.toggle'
    };
    let ClassNames = {
        NAVBAR_VERTICAL_COLLAPSED: 'close_icon',
    };
    let navbarVerticalToggle = document.querySelector(Selector.NAVBAR_VERTICAL_TOGGLE);
    let nav = document.querySelector(Selector.NAV);
    let header = document.querySelector(Selector.HEADER);

    if (navbarVerticalToggle) {
        navbarVerticalToggle.addEventListener(Events.CLICK, function (e) {
            navbarVerticalToggle.blur();
            nav.classList.toggle(ClassNames.NAVBAR_VERTICAL_COLLAPSED); // Set collapse state on localStorage
            header.classList.toggle(ClassNames.NAVBAR_VERTICAL_COLLAPSED); // Set collapse state on localStorage

            let isNavbarVerticalCollapsed = utils.getItemFromStore('isNavbarVerticalCollapsed');
            utils.setItemToStore('isNavbarVerticalCollapsed', !isNavbarVerticalCollapsed);
            let event = new CustomEvent(Events.NAVBAR_VERTICAL_TOGGLE);
            e.currentTarget.dispatchEvent(event);
        });
    }
};

/* ------------------------------------------------------------------------------------------------------------ */
/*                                Theme Control
/* ------------------------------------------------------------------------------------------------------------ */
let changeTheme = function changeTheme(element) {
    element.querySelectorAll('[data-theme-control = "theme"]').forEach(function (el) {
        let localStorageValue = getItemFromStore('theme');

        if (el.type === 'checkbox') {
            localStorageValue === 'dark' ? el.checked = true : el.checked = false;
        } else {
            localStorageValue === el.value ? el.checked = true : el.checked = false;
        }
    });
};
$(".mode").on("click", function () {
    const BODY = $('body')

    $('.mode i').toggleClass("fa-moon").toggleClass("fa-lightbulb");
    BODY.toggleClass("dark-only");

    localStorage.setItem('theme', (BODY.hasClass('dark-only') ? 'dark' : 'light'));
});

docReady(handleNavbarVerticalCollapsed);
