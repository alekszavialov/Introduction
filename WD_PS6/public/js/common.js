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
        const data = 'className=loadMessagesManipulate&timeZone=' + timezone_offset_minutes + '&messageCount=' + messageCount;
        $.ajax({
            type: method,
            url: action,
            data: data,
            dataType: 'json',
            cache: false
        }).done(function (data) {
            if (data["messages"] && data["messagesCount"] !== messageCount) {
                $chatBody.html(data["messages"]);
                messageCount = data["messagesCount"];
                $chatBody.scrollTop($chatBody.prop("scrollHeight"));
            }
        });
    }

    $form.on("submit", (function (e) {
        e.preventDefault();
        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData) {
            return;
        }
        const data = 'className=addMessageManipulate&' + $form.serialize();
        $.ajax({
            type: method,
            url: action,
            data: data
        }).done(function (data) {
            if (!data) {
                $messageValue.val("");
                loadMessage();
                $error.text("");
            } else {
                $error.text(data);
            }
        }).fail(function () {
            $error.text("Cant write file!");
        });
    }));

    loadMessage();
    setInterval(loadMessage, 1000);

});