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
        customBlock(e.pageX, e.pageY);
    }).
    /**
     * Find ative div and remove active from it. Set current div active and show input;
     */
    on('dblclick', '.draggable-block', function (e) {
        e.stopPropagation();
        let $currentDivInput = $(this).find('input');
        if ($currentDivInput.is(':visible')) {
            return;
        }
        checkActiveBlock();
        $(this).addClass('active');
        $currentDivInput.val($(this).find('p').text()).fadeIn().focus();
    }).
    /**
     * When pressed enter button - add data from input to paragraph and hide input;
     * When pressed esc button - hide input;
     */
    on('keyup', '.active input', function (e) {
        if (e.keyCode === ENTER_BUTTON) {
            const $block = $(this).parent();
            changeBlock($block.attr('id'), $block.position().left, $block.position().top, $(this).val());
        } else if (e.keyCode === ESC_BUTTON) {
            $(this).fadeOut();
        }
    }).
    /**
     * Hide active input;
     */
    on('click', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        checkActiveBlock();
    }).
    /**
     * Change current div coords;
     */
    on('dragstop', '.draggable-block', function () {
        changeBlock($(this).attr('id'), `${$(this).position().left}`, $(this).position().top, $(this).find('p').text());
    });

    /**
     * Check active block. If find active block - remove class active from it and clean input value;
     */
    function checkActiveBlock() {
        const $activeBlock = $('.active');
        if ($activeBlock) {
            $activeBlock.find('input').val('').fadeOut();
            $activeBlock.removeClass('active');
        }
    }

    /**
     * Create div
     *
     * @param objects   div parameters
     */
    function createBlock(objects) {
        const $block = $('<div />')
            .addClass('draggable-block')
            .attr('id', `${objects.id}`)
            .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`, position: 'absolute'})
            .append($('<p />').text(`${objects.message}`))
            .append($('<input />').val(`${objects.message}`))
            .draggable({containment: "#main", scroll: false});
        $mainBody.append($block);
    }

    /**
     * Add new block in cursor coords;
     *
     * @param positionX mouse position from left
     * @param positionY mouse position from right
     */
    function customBlock(positionX, positionY) {
        $.ajax({
            type: 'POST',
            data: {
                addNewDiv: '',
                positionX: `${positionX}`,
                positionY: `${positionY}`
            },
            url: '../app/handler.php',
            cache: false,
            dataType: 'json',
        }).done(function (objects) {
            createBlock(objects);
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
                if (objects[i].active === true) {
                    createBlock(objects[i]);
                }
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
            let $currentBlock = $(`#${id}`);
            if (objects.active === false) {
                $currentBlock.fadeOut();
            } else {
                $currentBlock
                    .css({top: `${objects.positionY}px`, left: `${objects.positionX}px`})
                    .find('p').text(objects.message);
                $currentBlock.find('input').fadeOut();
            }
        })
    }

});
