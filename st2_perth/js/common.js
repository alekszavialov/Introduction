$(function () {
    const $menu = $('.menu');
    const $navigation = $('.navigation');
    const animationSpeed = 500;

    $menu.on('click', function () {
        $('.menu').toggleClass('menu-active');
        $navigation.fadeToggle('fast');
    });


    $('.up-page').on('click', function () {
        $('html').animate({
            scrollTop: 0
        }, 500);
    });

    $('.navigation a[href^="#"]').on('click', function () {
        event.preventDefault();
        const $element = $($.attr(this, 'href'))
        const elOffset = $element.offset().top;
        const elHeight = $element.height();
        const windowHeight = $(window).height();
        let offset = elOffset;
        if (elHeight < windowHeight && elOffset > windowHeight / 2) {
            offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
        }
        $menu.click();
        $('html').animate({
            scrollTop: offset
        }, animationSpeed);
    })
});