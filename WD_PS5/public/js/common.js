$(function () {

    const $form = $("#chat-Form");
    const $error = $(".errorArea");
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
    }

    $form.submit(function (e) {
        e.preventDefault();
        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData){
            return;
        }
        const data = 'userMessage=' + $messageValueData;
        $.ajax({
            type: method,
            url: action,
            data: data,
            success: function (data) {
                if (data) {
                    $error.text(data);
                    return;
                }
                $messageValue.val("");
                loadMessage();
            }
        });
    });

    loadMessage();
    setInterval(loadMessage, 1000);

});