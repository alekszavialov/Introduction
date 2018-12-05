const enterButton = 13;
const escButton = 27;

$(function (asd) {



    $('.draggable-block').draggable();

    $('#main').on('dblclick', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('main db');
        customBlock(e.pageX, e.pageY);
    }).on('dblclick', '.draggable-block', function (e) {
        e.stopPropagation();
        console.log('draggable click');
        $(this).css('background-color', getRandomColor());
        $(this).addClass('active');
        $(this).find('input').fadeIn().focus();
    }).on('dblclick', '.draggable-block input', function (e) {
        e.stopPropagation();
        $(this).parent().find('p').text($(this).val());
    }).on('keyup', '.draggable-block input', function (e) {
        e.stopPropagation();
        console.log('input keyup');
        if (e.keyCode === enterButton){
            $(this).parent().find('p').text($(this).val());
            $(this).fadeOut();
        } else
        if (e.keyCode === escButton){
            $(this).parent().removeClass('active');
            $(this).fadeOut();
        }
    }).on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('main click');
        $activeBlock = $('.active');
        if ($activeBlock){
            $activeBlock.find('input').fadeOut();
            $activeBlock.removeClass('active');
        }
    });

    function customBlock(positionX, positionY) {
        const container = $('#main');
        const div = $('<div />').addClass('draggable-block').css({top: `${positionY}px`, left: `${positionX}px`,
            position: 'absolute'}).draggable().append($('<p />')).append($('<input />'));;
        container.append(div);
    }

});

function getRandomColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}