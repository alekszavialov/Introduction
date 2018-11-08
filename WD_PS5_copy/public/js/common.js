$(function () {

    const $form = $("#chat-Form");
    const $error = $(".errorArea");
    const $chatBody = $("#message-chat");
    const action = "handler/handler.php";
    const timeout = 2000;
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0 ? 0 : -timezone_offset_minutes;
    let messageCount = 0;
    let addMessageStatus = false;
    let loadMessages;


    function loadMessage() {
        const data = 'className=loadMessagesManipulate&timeZone=' + timezone_offset_minutes + '&messageCount=' + messageCount;
        $.ajax({
            type: 'GET',
            url: action,
            data: data,
            dataType: 'json',
            cache: false
        }).done(function (data) {
            // $chatBody.html(data.data.messages);
            // messageCount = data.data.messagesCount;
            // $chatBody.scrollTop($chatBody.prop("scrollHeight"));
            //  alert(data.data.messages)
            //addMessagesToChat(data.data.messages);
            alert(JSON.parse(data.data.messages));
            $.each(data.data.messages, function(i, item) {
                alert(item);
            });
            addMessagesToChat(data.data.messages, data.data.currentUser);
            messageCount = data.data.messagesCount;
            loadMessages = setTimeout(loadMessage, timeout);
        }).fail(function (xhr) {
            if (xhr.status === 202) {
                loadMessages = setTimeout(loadMessage, timeout);
            } else {
                //  logOut();
            }
        });
    }

    $form.on("submit", (function (e) {
            e.preventDefault();
            if (addMessageStatus) {
                return;
            }
            clearTimeout(loadMessages);
            const $messageValue = $("#message-value");
            let $messageValueData = $messageValue.val();
            if (!$messageValueData.replace(/\s+/g, '')) {
                $messageValue.val("");
                return;
            }
            const data = 'className=addMessageManipulate&' + $form.serialize();
            $messageValue.attr('readonly', true);
            sendMessage(data, $messageValue);
            loadMessage();
        })
    );

    $("#logout").click(function () {
        logOut();
    });

    function logOut() {
        const data = 'className=loginManipulate&logout=true';
        $.ajax({
            type: 'POST',
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

    function sendMessage(data, $messageValue) {
        addMessageStatus = true;
        $.ajax({
            type: 'POST',
            url: action,
            data: data,
            dataType: 'json',
            cache: false
        }).done(function () {
            $messageValue.val("");
            $error.text("");
            addMessageStatus = false;
            $messageValue.attr('readonly', false);
        }).fail(function (xhr) {
            if (xhr.status === 400) {
                $error.text(xhr.responseText);
                $messageValue.attr('readonly', false);
                addMessageStatus = false;
            } else {
                //  logOut();
            }
        });
    }

    function addMessagesToChat(data, user) {
        $.each(data, function(item) {
            if (item.name === user){
                alert(item.name);
            }
        });
        // $chatBody.html(data.data.messages);
        // messageCount = data.data.messagesCount;
        //
//        return $_SESSION['user_name'] === $value['name'] ?
//            "<p style='text-align: right'>{$value["message"]} : <strong>You ({$value["name"]})</strong> [{$hour}:{$minute}:{$second}]</p>"
//            : "<p>[{$hour}:{$minute}:{$second}] <strong>{$value["name"]}</strong>: {$value["message"]}</p>";
     //   $chatBody.scrollTop($chatBody.prop("scrollHeight"));
    }

    loadMessage();

});