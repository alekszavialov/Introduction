const ENTER_BUTTON = 13;
const ESC_BUTTON = 27;

$(function () {

    const $mainBody = $('#main');

    getBlocks();

    /**
     *
     */
    $mainBody.on('dblclick', function (e) {
        e.stopPropagation();
        console.log('main db');
        customBlock(e.pageX, e.pageY);
    }).on('dblclick', '.draggable-block', function (e) {
        e.stopPropagation();
        console.log('draggable click');
        $(this).addClass('active');
        $(this).find('input').fadeIn().focus();
    }).on('dblclick', '.draggable-block input', function (e) {
        e.stopPropagation();
        $(this).parent().find('p').text($(this).val());
    }).on('keyup', '.draggable-block input', function (e) {
        e.stopPropagation();
        console.log('input keyup');
        if (e.keyCode === ENTER_BUTTON) {
            changeBlock($(this).parent().attr('id'), '', '', $(this).val());
        } else if (e.keyCode === ESC_BUTTON) {
            $(this).parent().removeClass('active');
            $(this).fadeOut();
        }
    }).on('click', function (e) {
        if (!$(event.target).is($(this))) {
            return;
        }
        e.stopPropagation();
        console.log('main click');
        const $activeBlock = $('.active');
        if ($activeBlock) {
            $activeBlock.find('input').fadeOut();
            $activeBlock.removeClass('active');
        }
    }).on('mouseup', '.ui-draggable-dragging', function (e) {
        e.stopPropagation();
        console.log('changeBlock');
        changeBlock($(this).attr('id'), `${$(this).position().left}`, $(this).position().top, $(this).val());
    });

    function createBlock(objects) {
        const $block = $('<div />')
            .addClass('draggable-block')
            .attr('id', `${objects['id']}`)
            .css({top: `${objects['positionY']}px`, left: `${objects['positionX']}px`, position: 'absolute'})
            .append($('<p />').text(`${objects['message']}`))
            .append($('<input />').val(`${objects['message']}`))
            .draggable({containment: "#main", scroll: false});
        $mainBody.append($block);
    }

    function customBlock(positionX, positionY) {
        console.log(positionX + " " + positionY);
        const data = `addNewDiv&positionX=${positionX}&positionY=${positionY}`
        $.ajax({
            type: 'POST',
            data: data,
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            createBlock(objects);
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
                createBlock(objects[i]);
            }
        })
    }

    function changeBlock(id, positionX, positionY, message) {
        console.log(id + " " + positionX + " " + positionY + " " + message);
        const data = 'changeBlock&id=' + id + '&positionX=' + positionX + '&positionY='
            + positionY + '&message=' + message;
        $.ajax({
            type: 'POST',
            url: '../app/handler.php',
            data: data,
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            console.log(objects);
            let $currentBlock = $(`#${id}`);
            return;
            if (!objects['message']){
                $currentBlock.fadeOut();
            } else {
                $currentBlock
                    .css({top: `${objects['positionY']}px`, left: `${objects['positionX']}px`})
                    .find('p').text(objects['message']);
                $currentBlock.find('input').fadeOut();
            }
        })
    }

});
