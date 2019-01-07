$(function () {

    const $form = $("#chat-Form");
    const $error = $(".errorArea");
    const $chatBody = $("#message-chat");
    const action = "../handler/handler.php";
    const timeout = 2000;
    const maxMessageLenght = 500;
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0 ? 0 : -timezone_offset_minutes;
    let messageCount = 0;
    let addMessageStatus = false;
    let loadMessages;

    function loadMessage() {
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                className: 'loadMessages',
                timeZone: timezone_offset_minutes,
                messageCount: messageCount
            },
            dataType: 'json',
            cache: false
        }).done(function (data) {
            addMessagesToChat(data);
            messageCount = data.messages[data.messages.length - 1].id;
            loadMessages = setTimeout(loadMessage, timeout);
        }).fail(function (xhr) {
            if (xhr.status === 202) {
                loadMessages = setTimeout(loadMessage, timeout);
            } else {
                logOut();
            }
        });
    }

    $form.on("submit", (function (e) {
        e.preventDefault();
        if (addMessageStatus) {
            return;        }

        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData.replace(/\s+/g, "")) {
            $messageValue.val("");
            $error.text("Cant send empty message");
            return;
        }
        if ($messageValueData.length > maxMessageLenght) {
            $error.text("Long message! Max 500 characters");
            return;
        }
        const data = $form.serialize() + '&' + $.param({"className": "addMessage"});
        $messageValue.attr('readonly', true);
        clearTimeout(loadMessages);
        sendMessage(data, $messageValue);
    }));

    $("#logout").click(function () {
        clearTimeout(loadMessages);
        logOut();
    });

    function logOut() {
        $.ajax({
            type: 'POST',
            url: action,
            data: {
                className: "loginManipulate",
                logout: "true"
            },
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
            loadMessage();
        }).fail(function (xhr) {
            console.log(xhr);
            if (xhr.status === 400) {
                $error.text(xhr.responseText);
                $messageValue.attr('readonly', false);
                addMessageStatus = false;
                loadMessage();
            } else {
                logOut();
            }
        });
    }

    function addMessagesToChat(data) {
        $chatBody.html("");
        $.each(data.messages, function (i, item) {
            item.message = item.message.replace(/:\)/g, "<span class='happy-smile'></span>")
                .replace(/:\(/g, "<span class='sad-smile'></span>");
            const itemField = item.name === data.currentUser ? $("<p />").css("text-align", "right")
                    .html(`${item.message} : <strong>You (${item.name})</strong> ${item.time}`) :
                $("<p />").css("text-align", "left")
                    .html(`${item.time} <strong>${item.name}</strong>: ${item.message}`);
            $chatBody.append(itemField);
        });
        $chatBody.scrollTop($chatBody.prop("scrollHeight"));
    }

    loadMessage();

});