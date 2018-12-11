const ENTER_BUTTON = 13;
const ESC_BUTTON = 27;
const AJAX_URL = '../app/handler.php';
const NODE_CONTAINER = 'draggable-block';
const ERROR_MESSAGE = 'Oops, something goes wrong :( Reload page';
const INPUT_TEXT_MAX_LENGHT = 255;
const ACTIVE_CLASS = 'active';
const MAIN_BODY = 'main';

$(function () {

    /**
     * @type {*|jQuery|HTMLElement}
     */
    const $mainBody = $('#' + MAIN_BODY);

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
    }).fail(function () {
        programDestroy();
    });

    /**
     * Create block on main div;
     */
    $mainBody.on('dblclick', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        const emptyBlock = {
            'positionX': e.pageX,
            'positionY': e.pageY,
            'message': ''
        };
        createBlock(emptyBlock);
        const $createdBlock = $(this).find('.' + NODE_CONTAINER + ':last');
        $createdBlock.addClass(ACTIVE_CLASS);
        $createdBlock.find('input').focus();
    }).on('dblclick', `.${NODE_CONTAINER}`, function () {
        if ($(this).hasClass(ACTIVE_CLASS)) {
            return;
        }
        $(this).addClass(ACTIVE_CLASS);
        $(this).find('input').val($(this).find('p').text().trim()).focus();
    }).on('blur', `.${NODE_CONTAINER} input`, function () {
        const $parentContainer = $(this).parent();
        const inputText = $(this).val().trim();
        if (!$parentContainer.is('[id]') && !inputText) {
            removeBlock($parentContainer);
        } else if (!$parentContainer.is('[id]') && inputText) {
            addNewBlock($parentContainer,
                $parentContainer.position().left,
                $parentContainer.position().top,
                inputText);
        } else if (inputText !== $parentContainer.find('p').text()) {
            changeBlock($parentContainer.attr('id'),
                $parentContainer.position().left,
                $parentContainer.position().top,
                inputText);
        }
        $parentContainer.removeClass(ACTIVE_CLASS);
    }).on('keyup', '.' + ACTIVE_CLASS + ' input', function (e) {
        if (e.keyCode === ENTER_BUTTON) {
            $(this).blur();
        } else if (e.keyCode === ESC_BUTTON) {
            const $parentBlock = $(this).parent();
            $(this).val($parentBlock.find('p').text());
            $parentBlock.removeClass(ACTIVE_CLASS);
        }
    }).on('dragstop', '.draggable-block', function () {
        changeBlock($(this).attr('id'), $(this).position().left, $(this).position().top, $(this).find('p').text());
    });

    function removeBlock(block) {
        $.when(block.fadeOut('fast')).done(function () {
            block.remove();
        });
    }

    function createBlock(objects) {
        let $block = $('<div />')
            .addClass(`${NODE_CONTAINER}`)
            .css({top: objects.positionY + 'px', left: objects.positionX + 'px', position: 'absolute'})
            .append($('<p />').text(`${objects.message}`))
            .append($('<input />').attr({maxlength: INPUT_TEXT_MAX_LENGHT}).val(objects.message));
        if (objects.id) {
            $block.attr('id', objects.id);
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
            object.css({top: objectPositionY + 'px', left: objectPositionX + 'px'});
        }
        object.draggable({containment: "#main", scroll: false});
    }

    function addNewBlock($activeBlock, positionX, positionY, message) {
        $.ajax({
            type: 'POST',
            data: {
                function: 'insertItem',
                positionX: positionX,
                positionY: positionY,
                message: message
            },
            url: AJAX_URL,
            dataType: 'json',
        }).done(function (object) {
            $activeBlock.attr('id', object.id);
            $activeBlock.find('p').text(object.message);
        }).fail(function () {
            programDestroy();
        });
    }

    function changeBlock(id, positionX, positionY, message) {
        $.ajax({
            type: 'POST',
            data: {
                function: 'editItem',
                id: id,
                positionX: positionX,
                positionY: positionY,
                message: message
            },
            url: AJAX_URL,
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            let $currentBlock = $('#' + objects.id);
            if (objects.active === false) {
                removeBlock($currentBlock);
            } else if (objects.id) {
                $currentBlock
                    .css({top: objects.positionY + 'px', left: objects.positionX + 'px'})
                    .find('p').text(objects.message)
                    .find('input').val(objects.message);
                correctingPosition($currentBlock);
            }
        }).fail(function () {
            programDestroy();
        });
    }

    function programDestroy() {
        $(`.${NODE_CONTAINER}`).each(function () {
            removeBlock($(this));
        });
        const $errorBlock = $('<span />')
            .addClass(`errorMessage`)
            .text(ERROR_MESSAGE);
        $mainBody.append($errorBlock);
    }

    $(window).on('resize', function () {
        $(`.${NODE_CONTAINER}`).each(function () {
            correctingPosition($(this));
        });
    });

});
