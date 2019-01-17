$(function () {

    const $chatForm = $("#chat-Form");
    const $errorArea = $(".errorArea");
    const $chatBody = $("#message-chat");
    const timeout = 2000;
    const maxMessageLength = 500;
    let messagesCount = 0;
    let addMessageStatus = false;
    let loadMessages;
    const loger = new Loger();

    function loadMessage() {
        let functionName = 'loadMessage';
        $.ajax({
            type: "GET",
            url: "/dashboard/loadMessage",
            data: {
                messagesCount: messagesCount
            },
            dataType: "json",
            cache: false
        }).done(function (data) {
            addMessagesToChat(data.messages, data.currentUser);
            messagesCount = data.messagesCount;
            loger.addLog(functionName, 'done');
            loadMessages = setTimeout(loadMessage, timeout);
        }).fail(function (xhr) {
            if (xhr.status === 202) {
                loadMessages = setTimeout(loadMessage, timeout);
            } else {
                $errorArea.text(xhr.responseText);
                loger.addLog(functionName, 'fail', xhr.responseText);
            }
        });
    }

    $chatForm.on("submit", (function (e) {
        e.preventDefault();
        if (addMessageStatus) {
            return;
        }
        let functionName = 'formSubmit';
        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData.replace(/\s+/g, "")) {
            $messageValue.val("");
            let error = "Cant send empty message";
            $errorArea.text(error);
            loger.addLog(functionName, 'fail', error);
            return;
        }
        if ($messageValueData.length > maxMessageLength) {
            let error = "Long message! Max 500 characters";
            $errorArea.text(error);
            loger.addLog(functionName, 'fail', error);
            return;
        }
        const data = $chatForm.serialize();
        $messageValue.attr("readonly", true);
        clearTimeout(loadMessages);
        sendMessage(data, $messageValue);
    }));

    $("#logout").click(function () {
        logOut();
    });

    function logOut() {
        let functionName = 'logOut';
        $.ajax({
            type: "POST",
            url: "/dashboard/logOut",
            cache: false
        }).always(function () {
            loger.addLog(functionName, '');
            window.location.href = location.protocol + '//' + location.host;
        });
    }

    function sendMessage(data, $messageValue) {
        addMessageStatus = true;
        let functionName = 'sendMessage';
        $.ajax({
            type: "POST",
            url: "/dashboard/addMessage",
            data: data,
            dataType: "json",
            cache: false
        }).done(function () {
            $messageValue.val("");
            $errorArea.text("");
            addMessageStatus = false;
            $messageValue.attr("readonly", false);
            loger.addLog(functionName, 'done');
            loadMessage();
        }).fail(function (xhr) {
            if (xhr.status === 400) {
                $errorArea.text(xhr.responseText);
                $messageValue.attr("readonly", false);
                addMessageStatus = false;
                loadMessage();
            } else {
                $errorArea.text(xhr.responseText);
            }
            loger.addLog(functionName, 'fail', xhr.responseText);
        });
    }

    function addMessagesToChat(messages, currentUser) {
        $.each(messages, function (i, item) {
            item.message = item.message.replace(/:\)/g, "<span class='happy-smile'></span>")
                .replace(/:\(/g, "<span class='sad-smile'></span>");
            const itemField = item.user_name === currentUser ? $("<p />").css("text-align", "right")
                    .html(`${item.message} : <strong>You (${item.user_name})</strong> [${item.date}]`) :
                $("<p />").css("text-align", "left")
                    .html(`[${item.date}] <strong>${item.user_name}</strong>: ${item.message}`);
            $chatBody.append(itemField);
        });
        $chatBody.scrollTop($chatBody.prop("scrollHeight"));
    }

    loadMessage();

});
