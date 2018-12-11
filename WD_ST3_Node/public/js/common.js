const ENTER_BUTTON = 13;
const ESC_BUTTON = 27;
const AJAX_URL = '../app/handler.php';
const NODE_CONTAINER = 'draggable-block';
$(function () {

    /**
     * @type {*|jQuery|HTMLElement}
     */
    const $mainBody = $('#main');

    $.ajax({
        type: 'get',
        data: {
            function: 'loadItems'
        },
        url: AJAX_URL,
        cache: false,
        dataType: 'json',
    }).done(function (objects) {
        for (let i = 0; i < objects.length; i++) {
            createBlock(objects[i]);
        }
    });

    /**
     * Create block on main div;
     */
    $mainBody.on('dblclick', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        console.log('doubleClick! ' + e.target);
        const emptyBlock = {
            'positionX': e.pageX,
            'positionY': e.pageY,
            'message': ''
        };
        createBlock(emptyBlock);
        const $createdBlock = $(this).find('.' + NODE_CONTAINER + ':last');
        $createdBlock.addClass('active');
        $createdBlock.find('input').focus();
    }).on('dblclick', `.${NODE_CONTAINER}`, function (e) {
        if ($(this).hasClass('active')) {
            return;
        }
        console.log('doubleClick block!');
        $(this).addClass('active');
        $(this).find('input').val($(this).find('p').text().trim()).focus();
   //     $(`.${NODE_CONTAINER}`).draggable( "destroy" )
    }).on('blur', `.${NODE_CONTAINER} input`, function (e) {
        console.log('blur!');
        const $parentContainer = $(this).parent();
        const inputText = $(this).val().trim();
        if (!$parentContainer.is('[id]') && !inputText) {
            removeBlock($parentContainer);
        } else
        if (!$parentContainer.is('[id]') && inputText) {
            addNewBlock($parentContainer,
                $parentContainer.position().left,
                $parentContainer.position().top,
                inputText);
        } else
        if (inputText !== $parentContainer.find('p').text()) {
            changeBlock($parentContainer.attr('id'),
                $parentContainer.position().left,
                $parentContainer.position().top,
                inputText);
        }
        $parentContainer.removeClass('active');
    }).on('keyup', '.active input', function (e) {
        if (e.keyCode === ENTER_BUTTON) {
            console.log('enter!');
            $(this).blur();
        } else if (e.keyCode === ESC_BUTTON) {
            console.log('esc!');
            const $parentBlock = $(this).parent();
            $(this).val($parentBlock.find('p').text());
            $parentBlock.removeClass('active');
        }
    }).on('dragstop', '.draggable-block', function () {
        console.log('change pos!');
        changeBlock($(this).attr('id'), `${$(this).position().left}`, $(this).position().top, $(this).find('p').text());
    });

    function removeBlock(block) {
        $.when(block.fadeOut('fast')).done(function () {
            block.remove();
        });
    }

    function createBlock(objects) {
        let $block = $('<div />')
            .addClass(`${NODE_CONTAINER}`)
            .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`, position: 'absolute'})
            .append($('<p />').text(`${objects.message}`))
            .append($('<input />').val(`${objects.message}`));
        if (objects.id) {
            $block.attr('id', `${objects.id}`);
        }
        $mainBody.append($block);
        correctingPosition($block);
    }

    function correctingPosition(object) {
        const objectPosition = object.position();
        let objectPositionX = objectPosition.left;
        let objectPositionY = objectPosition.top;
        if (objectPositionX < 0) {
            objectPositionX = 0;
        }
        if (objectPositionY < 0) {
            objectPositionY = 0;
        }
        if (objectPositionY + object.outerHeight(true) > $mainBody.outerHeight()) {
            objectPositionY = $mainBody.outerHeight() - object.outerHeight(true);
        }
        if (objectPosition.left + object.outerWidth() > $mainBody.outerWidth()) {
            objectPositionX = $mainBody.outerWidth() - object.outerWidth();
        }
        if (objectPosition.left !== objectPositionX || objectPositionY !== objectPosition.top) {
            console.log('refactor!');
            object.css({top: `${objectPositionY}px`, left: `${objectPositionX}px`});
        }
        object.draggable({containment: "#main", scroll: false});
    }

    function addNewBlock($activeBlock, positionX, positionY, message) {
        console.log('add new block to db');
        $.ajax({
            type: 'POST',
            data: {
                function: 'insertItem',
                positionX: `${positionX}`,
                positionY: `${positionY}`,
                message: `${message}`
            },
            url: AJAX_URL,
            dataType: 'json',
        }).done(function (object) {
            console.log('add new block to db succsess!');
            $activeBlock.attr('id', object.id);
            $activeBlock.find('p').text(object.message);
        });
    }

    function changeBlock(id, positionX, positionY, message) {
        $.ajax({
            type: 'POST',
            data: {
                function: 'editItem',
                id: `${id}`,
                positionX: `${positionX}`,
                positionY: `${positionY}`,
                message: `${message}`
            },
            url: AJAX_URL,
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            let $currentBlock = $(`#${objects.id}`);
            if (objects.active === false) {
                console.log(`removed! ${objects.id}`);
                removeBlock($currentBlock);
            } else {
                $currentBlock
                    .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`})
                    .find('p').text(objects.message)
                    .find('input').val(objects.message);
                console.log(`change faded! ${objects.id}`);
            }
        });
    }

    $(window).on('resize', function(){
        console.log('resize');
        $(`.${NODE_CONTAINER}`).each(function() {
            correctingPosition($(this));
        });
    });

});


