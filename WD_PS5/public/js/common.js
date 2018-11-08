$(function () {

    const $form = $("#chat-Form");
    const $error = $(".errorArea");
    const method = $form.attr('method');
    const action = $form.attr('action');
    const $chatBody = $("#message-chat");
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
    let messageCount = 0;

    function loadMessage() {
        const data = 'className=loadMessagesManipulate&timeZone=' + timezone_offset_minutes + '&messageCount=' + messageCount;
        $.ajax({
            type: 'GET',
            url: action,
            data: data,
            dataType: 'json',
            cache: false
        }).done(function (data) {
            $chatBody.html(data.data.messages);
            messageCount = data.data.messagesCount;
            $chatBody.scrollTop($chatBody.prop("scrollHeight"));
        }).fail(function (xhr) {
            if (xhr.status !== 202) {
                logOut();
            }
        }).always(function () {
            loadMessage();
        });
    }

    $form.on("submit", (function (e) {
            e.preventDefault();
            const $messageValue = $("#message-value");
            let $messageValueData = $messageValue.val();
            if (!$messageValueData.replace(/\s+/g, '')) {
                $messageValue.val("");
                return;
            }
            const data = 'className=addMessageManipulate&' + $form.serialize();
            $.ajax({
                type: method,
                url: action,
                data: data,
                dataType: 'json',
                cache: false
            }).done(function () {
                $messageValue.val("");
                $error.text("");
            }).fail(function (xhr) {
                if (xhr.status === 400) {
                    $error.text(xhr.responseText);
                } else {
                    logOut();
                }
            })
        })
    );

    $("#logout").click(function () {
        logOut();
    });

    function logOut() {
        const data = 'className=loginManipulate&logout=true';
        $.ajax({
            type: method,
            url: action,
            data: data,
            dataType: 'json',
            cache: false
        }).done(function (data) {
            window.location.href = data.data;
        }).fail(function () {
            window.location.href = "index.php";
        });
    }

    loadMessage();
});