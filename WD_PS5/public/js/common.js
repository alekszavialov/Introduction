$(function () {

    const $form = $('#chat-Form');
    const method = $form.attr('method');
    const action = $form.attr('action');

    function loadMessage() {
        const $chatBody = $("#message-chat");
        const data = 'getMsg=true';
        $.ajax({
            type: method,
            url: action,
            data: data,
            success: function (result) {
                if (result) {
                    $chatBody.html(result);
                }
            }
        });

        $chatBody.scrollTop($chatBody.prop("scrollHeight"));
    };

    $form.submit(function (e) {
        e.preventDefault();
        const $messageValue = $('#message-value');
        const data = 'userMessage=' + $messageValue.val();
        $.ajax({
            type: method,
            url: action,
            data: data
        });
        $messageValue.val("");
        loadMessage();
    });
    loadMessage();
    setInterval(loadMessage, 1000);

});