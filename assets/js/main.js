;
(function ($) {
    // Scripts which runs after DOM load
    $(document).on('ready', function () {
        /* Scroll to Gravity Form confirmation message after form submit */
        $(document).on('gform_confirmation_loaded', function (event, formId) {
            let $target = $('#gform_confirmation_wrapper_' + formId);
            if ($target.length) {
                $('html, body').animate({
                    scrollTop: $target.offset().top - 50
                }, 500);
                return false;
            }
        });
    });

    // Scripts which runs after all elements load
    $(window).on('load', function () {
        if ($('.preloader').length) {
            $('.preloader').addClass('preloader--hidden');
        }

        // Anchor scroll with fixed header offset
        function scrollToAnchor(hash) {
            let target = $(hash),
                headerHeight = $('.header').height(); // Get fixed header height

            target = target.length ? target : $('[name=' + hash.slice(1) + ']');

            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - headerHeight
                }, 500);
                return false;
            }
        }

        if (window.location.hash) {
            scrollToAnchor(window.location.hash);
        }

        $('a[href*=\\#]:not([href=\\#])').click(function () {
            scrollToAnchor(this.hash);
        });

        // Responsive menu
        $('.burger-btn').click(function () {
            $(this).toggleClass('burger-btn--active');
            $('.header__nav').toggleClass('header__nav--active');
            $('body').toggleClass('overflow-hidden');
        });

        $('.header-menu__link').click(function () {
            $('.burger-btn').removeClass('burger-btn--active');
            $('.header__nav').removeClass('header__nav--active');
            $('body').removeClass('overflow-hidden');
        });
    });

    // Scripts which runs at window resize
    $(window).on('resize', function () {
        // Responsive menu
        if ($(window).width() >= 992) {
            $('.burger-btn').removeClass('burger-btn--active');
            $('.header__nav').removeClass('header__nav--active');
            $('body').removeClass('overflow-hidden');
        }
    });

    // Scripts which runs on scrolling
    $(window).on('scroll', function () {
        // jQuery code goes here
    });

}(jQuery));
