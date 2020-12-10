(function ($) {
    let side = $('.js-menu');
    let toggler = $('.js-menu-toggle');

    $(document).ready(function () {
        $('.js-menu-toggle').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                closeMenu();
            } else {
                openMenu();
            }

            $('.overlay').on('click', function () {
                closeMenu();
            })
        });
    });

    function openMenu() {
        $('body').addClass('menu-opened');
        toggler.addClass('active');
        side.addClass('active');
    }

    function closeMenu() {
        $('body').removeClass('menu-opened');
        toggler.removeClass('active');
        side.removeClass('active');
    }
})(jQuery);