const ENTER_BUTTON = 13;
const ESC_BUTTON = 27;


$(function () {

    /**
     * @type {*|jQuery|HTMLElement}
     */
    const $mainBody = $('#main');

    /**
     * Load blocks from database;
     */
    getBlocks();

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
            'message': '',
            'active': true
        };
        createBlock(emptyBlock);
        const $createdBlock = $(this).find('.draggable-block:last');
        $createdBlock.addClass('active');
        $createdBlock.find('input').fadeIn().focus();
    }).
    /**
     * Find ative div and remove active from it. Set current div active and show input;
     */
    on('dblclick', '.draggable-block', function (e) {
        if ($(this).hasClass('active')) {
            return;
        }
        activeBlockManipulation();
        $(this).addClass('active');
        $(this).find('input').val($(this).find('p').text().trim()).fadeIn().focus();

    }).
    /**
     * When pressed enter button - add data from input to paragraph and hide input;
     * When pressed esc button - hide input;
     */
    on('keyup', '.active input', function (e) {
        if (e.keyCode === ENTER_BUTTON) {
            activeBlockManipulation();
        } else if (e.keyCode === ESC_BUTTON) {
            $(this).val($(this).parent().find('p').text());
            console.log($(this).parent().find('p').text());
            console.log($(this).val());
            activeBlockManipulation();
        }
    }).
    /**
     * Hide active input;
     */
    on('click', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        activeBlockManipulation();
    }).
    /**
     * Change current div coords;
     */
    on('dragstop', '.draggable-block', function () {
        if (!$(this).is('[id]')) {
            return;
        }
        activeBlockManipulation();
        changeBlock($(this).attr('id'),
            $(this).position().left,
            $(this).position().top,
            $(this).find('input').val());
    });

    /**
     * Check active block. If find active block - remove class active from it and clean input value;
     */
    function activeBlockManipulation() {
        const $activeBlock = $('.active');
        if (!$activeBlock.hasClass('draggable-block')) {
            return;
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
        } else if (!$activeBlock.is('[id]') && inputValue) {
            addNewBlock($activeBlock,
                $activeBlock.position().left,
                $activeBlock.position().top,
                inputValue);
        }
        $activeBlock.find('input').fadeOut();
        $activeBlock.removeClass('active');
    }


    function removeBlock(block) {
        $.when(block.fadeOut()).done(function () {
            block.remove();
        });
    }

    /**
     * Create div
     *
     * @param objects   div parameters
     */
    function createBlock(objects) {
        //  objects = correctingPosition(objects);
        let $block = $('<div />')
            .addClass('draggable-block')
            .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`, position: 'absolute'})
            .append($('<p />').text(`${objects.message}`))
            .append($('<input />').val(`${objects.message}`))
            .draggable({containment: "#main", scroll: false});
        if (objects.id) {
            $block.attr('id', `${objects.id}`);
        }
        $mainBody.append($block);
        correctingPosition($block);
        //   console.log($block.outerWidth());
        //   console.log($block.outerHeight());

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
            $mainBody.append(object.draggable({containment: "#main", scroll: false}));
        }
    }

    /**
     *
     * @param $activeBlock
     * @param positionX
     * @param positionY
     * @param message
     */
    function addNewBlock($activeBlock, positionX, positionY, message) {
        $.ajax({
            type: 'POST',
            data: {
                addNewDiv: '',
                positionX: `${positionX}`,
                positionY: `${positionY}`,
                message: `${message}`
            },
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            console.log('add new block');
            $activeBlock.attr('id', objects.id);
            $activeBlock.find('p').text(objects.message);
        })
    }


    /**
     * Load blocks from database;
     */
    function getBlocks() {
        $.ajax({
            type: 'get',
            data: 'getBlocks',
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            for (let i = 0; i < objects.length; i++) {
                createBlock(objects[i]);
            }
        })
    }

    /**
     * Change div position or text;
     *
     * @param id            div id
     * @param positionX     div position from left
     * @param positionY     div position from top
     * @param message       div input message
     */
    function changeBlock(id, positionX, positionY, message) {
        $.ajax({
            type: 'POST',
            data: {
                changeBlock: '',
                id: `${id}`,
                positionX: `${positionX}`,
                positionY: `${positionY}`,
                message: `${message}`
            },
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            console.log('change block!!!!');
            let $currentBlock = $(`#${objects.id}`);
            if (objects.active === false) {
                removeBlock($currentBlock);
                return;
            }
            $currentBlock
                .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`})
                .find('p').text(objects.message)
                .find('input').val(objects.message);
            console.log(`change faded! ${objects.id}`);
        })
    }

});
