const ENTER_BUTTON = 13;
const ESC_BUTTON = 27;
const AJAX_URL = '../app/handler.php';
$(function () {

    /**
     * @type {*|jQuery|HTMLElement}
     */
    const $mainBody = $('#main');

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
        const $createdBlock = $(this).find('.draggable-block:last');
        $createdBlock.addClass('active');
        $createdBlock.find('input').fadeIn().focus();
    }).on('click', function (e) {
        if (!$(e.target).is($(this))) {
            return;
        }
        activeBlockManipulation();
    }).on('dblclick', '.draggable-block', function (e) {
        if ( $(this).hasClass('active')) {
            return;
        }
        activeBlockManipulation()
        $(this).addClass('active');
        $(this).find('input').val( $(this).find('p').text().trim()).fadeIn().focus();

       // activeBlockManipulation();


    });

    function activeBlockManipulation() {
        const $activeBlock = $('.active');
        if (!$activeBlock.hasClass('draggable-block')) {
            return true;
        }
        const inputValue = $activeBlock.find('input').val().trim();
        if (!$activeBlock.is('[id]') && !inputValue) {
            console.log('remove new block!');
            removeBlock($activeBlock);
            return true;
        }
        if ($activeBlock.is('[id]') && $activeBlock.find('p').text() !== inputValue) {
            console.log('change block!');
            // changeBlock($activeBlock.attr('id'),
            //     $activeBlock.position().left,
            //     $activeBlock.position().top,
            //     inputValue);
        } else if (!$activeBlock.is('[id]') && inputValue) {
            $activeBlock.find('p').text(inputValue);
            // addNewBlock($activeBlock,
            //     $activeBlock.position().left,
            //     $activeBlock.position().top,
            //     inputValue);
        }
        $activeBlock.find('input').fadeOut();
        $activeBlock.removeClass('active');
        return true;
    }

    function removeBlock(block) {
        $.when(block.fadeOut()).done(function () {
            block.remove();
        });
    }

    function createBlock(objects) {
        let $block = $('<div />')
            .addClass('draggable-block')
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

});
