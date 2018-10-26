$(function () {

    const $form = $("#chat-Form");
    const $error = $(".errorArea");
    const method = $form.attr('method');
    const action = $form.attr('action');
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
    let messageCount = 0;

    function loadMessage() {
        const $chatBody = $("#message-chat");
        const data = 'getMsg=true&timeZone=' + timezone_offset_minutes + '&messageCount=' + messageCount;
        $.ajax({
            type: method,
            url: action,
            data: data,
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (result && result[1] !== messageCount) {
                    $chatBody.html(result[0]);
                    messageCount = result[1];
                }
            }
        });
        $chatBody.scrollTop($chatBody.prop("scrollHeight"));
    }

    $form.submit(function (e) {
        e.preventDefault();
        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData) {
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