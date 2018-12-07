const enterButton = 13;
const escButton = 27;

$(function () {

    getBlocks();

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
        if (e.keyCode === enterButton) {
            $(this).parent().find('p').text($(this).val());
            $(this).fadeOut();
        } else if (e.keyCode === escButton) {
            $(this).parent().removeClass('active');
            $(this).fadeOut();
        }
    }).on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('main click');
        $activeBlock = $('.active');
        if ($activeBlock) {
            $activeBlock.find('input').fadeOut();
            $activeBlock.removeClass('active');
        }
    });

    function customBlock(positionX, positionY) {
        // const container = $('#main');
        // const div = $('<div />').addClass('draggable-block').css({
        //     top: `${positionY}px`, left: `${positionX}px`,
        //     position: 'absolute'
        // }).draggable({containment: "#main", scroll: false}).append($('<p />')).append($('<input />'));
        // container.append(div);
        $.ajax({
            type: 'POST',
            data: `addNewDiv&positionX=${positionX}&positionY=${positionY}`,
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
                $block = $('<div />').addClass('draggable-block').attr('id', `${objects['id']}`).css({
                    top: `${objects['positionY']}px`, left: `${objects['positionX']}px`, position : "absolute"
                }).append($('<p />').text(`${objects['message']}`)).append($('<input />'))
                    .draggable({containment: "#main", scroll: false});
                $('#main').append($block);
        })
    }

    function getBlocks() {
        $.ajax({
            type: 'GET',
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            for (let i = 0; i < objects.length; i++) {
                $block = $('<div />').addClass('draggable-block').attr('id', `${objects[i]['id']}`).css({
                    top: `${objects[i]['positionY']}px`, left: `${objects[i]['positionX']}px`
                }).append($('<p />').text(`${objects[i]['message']}`)).append($('<input />'))
                    .draggable({containment: "#main", scroll: false});
                $('#main').append($block);
                alert(i);
            }
        })
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