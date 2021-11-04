let customCard = {
    init: function () {
        $(".setting-list .close-card").on('click', function () {
            let $this = $(this);
            $this.parents('.card').animate({
                'opacity': '0',
                '-webkit-transform': 'scale3d(.3, .3, .3)',
                'transform': 'scale3d(.3, .3, .3)'
            });
            setTimeout(function () {
                $this.parents('.card').remove();
            }, 800);
        }), $(".setting-list .reload-card").on('click', function () {
            let $this = $(this);
            $this.parents('.card').addClass("card-load");
            $this.parents('.card').append('<div class="loader-box card-loader"><div class="loader card-load"><div class="whirly-loader"></div></div></div>');
            setTimeout(function () {
                $this.parents('.card').children(".card-loader").remove();
                $this.parents('.card').removeClass("card-load");
            }, 3000);
        }), $(".setting-list .setting-option .icon-settings").on('click', function () {
            let $this = $(this);
            if ($this.hasClass('icon-angle-double-right')) {

                $this.parents('.setting-option').animate({
                    'width': '35px',
                });
            } else {
                $this.parents('.setting-option').animate({
                    'width': '230px',
                });
            }
            $(this).toggleClass("icon-angle-double-right").fadeIn('slow');
        }), $(".setting-list .minimize-card").on('click', function () {
            let $this = $(this);
            let port = $($this.parents('.card'));
            let card = $(port).children('.card-body').slideToggle();
            $(this).toggleClass("icofont-plus").fadeIn('slow');
        }), $(".setting-list .full-card").on('click', function () {
            let $this = $(this);
            let port = $($this.parents('.card'));
            port.toggleClass("full-card");
            $(this).toggleClass("icofont-resize");
        }), $(".view-html").on('click', function () {
            let html_source = $(this).parents(".card");
            let html_chield = html_source.find(".card-body");
            html_chield.toggleClass("show-source");
            $(this).toggleClass("fa-eye");
        }), $(document).ready(function () {
            let clipboard = new ClipboardJS('.btn-clipboard');
            clipboard.on('success', function (e) {
                e.querySelector();
                e.clearSelection();
            });
            clipboard.on('error', function (e) {
            });
        });
        $(".rtl .card-header-left .close-card").on('click', function () {
            let $this = $(this);
            $this.parents('.card').animate({
                'opacity': '0',
                '-webkit-transform': 'scale3d(.3, .3, .3)',
                'transform': 'scale3d(.3, .3, .3)'
            });
            setTimeout(function () {
                $this.parents('.card').remove();
            }, 800);
        }), $(".rtl .setting-list .setting-option .icon-angle-double-right").on('click', function () {
            let $this = $(this);
            if ($this.hasClass('icofont-simple-left')) {
                $this.parents('.setting-option').animate({
                    'width': '35px',
                });
            } else {
                $this.parents('.setting-option').animate({
                    'width': '230px',
                });
            }
            $(this).toggleClass("icofont-simple-left").fadeIn('slow');
        });
    }
};

(function ($) {
    "use strict";
    customCard.init()
})(jQuery);
