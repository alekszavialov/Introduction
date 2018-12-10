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
        console.log('doubleClick!');
        const emptyBlock = {
            'positionX': e.pageX,
            'positionY': e.pageY,
            'message': ''
        };
        createBlock(emptyBlock);
        const $createdBlock = $(this).find('.' + NODE_CONTAINER + ':last');
        $createdBlock.addClass('active');
        $createdBlock.find('input').focus();
    }).on('click', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        console.log('Click!');
        activeBlockManipulation();
    }).on('dblclick', `.${NODE_CONTAINER}`, function (e) {
        if ($(this).hasClass('active')) {
            return;
        }
        console.log('doubleClick block!');
        activeBlockManipulation();
        $(this).addClass('active');
        $(this).find('input').val($(this).find('p').text().trim()).focus();
    });

    function activeBlockManipulation() {
        const $activeBlock = $('.active');
        if (!$activeBlock.hasClass(`${NODE_CONTAINER}`)) {
            return true;
        }
        const inputValue = $activeBlock.find('input').val().trim();
        if (!$activeBlock.is('[id]') && !inputValue) {
            console.log('remove new block!');
            removeBlock($activeBlock);
            return;
        }
        if ($activeBlock.is('[id]') && $activeBlock.find('p').text() !== inputValue) {
            console.log('change block!');
            changeBlock($activeBlock.attr('id'),
                $activeBlock.position().left,
                $activeBlock.position().top,
                inputValue);
            $activeBlock.removeClass('active');
        } else if (!$activeBlock.is('[id]') && inputValue) {
            // $activeBlock.find('p').text(inputValue);
            $activeBlock.removeClass('active');
            addNewBlock($activeBlock,
                $activeBlock.position().left,
                $activeBlock.position().top,
                inputValue);
        } else {
            $activeBlock.removeClass('active');
        }

    }

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
            object.remove();
            object.css({top: `${objectPositionY}px`, left: `${objectPositionX}px`});
            $mainBody.append(object);
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
            let currentBlock = $(`#${object.id}`);
            currentBlock.find('p').text(object.message);
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
                $mainBody.remove(`#${objects.id}`);
                // $.when($currentBlock.fadeOut('fast')).done(function () {
                //     $currentBlock.remove();
                // });
                return;
            }
            $currentBlock
                .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`})
                .find('p').text(objects.message)
                .find('input').val(objects.message);
            console.log(`change faded! ${objects.id}`);
        });
    }

});
