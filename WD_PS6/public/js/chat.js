const timeout = 2000;
const maxMessageLength = 500;
let messagesCount = 0;
let addMessageStatus = false;
let loadMessages;
const xhrMessages = {
    401 : "You need to login!",
    404 : "Page issue. Try again later.",
    406 : "Incorrect message!",
    503 : "Service unavailable. Try again later"
};

$(function () {

    const $chatForm = $("#chat-Form");
    const $errorArea = $(".errorArea");
    const $chatBody = $("#message-chat");

    function loadMessage() {
        $.ajax({
            type: "GET",
            url: "/dashboard/loadMessage",
            data: {
                messagesCount: messagesCount
            },
            dataType: "json",
            cache: false
        }).done(function (data, status, xhr) {
            if (xhr.status === 200){
                addMessagesToChat(data.messages, data.currentUser);
                messagesCount = data.messagesCount;
            }
            loadMessages = setTimeout(loadMessage, timeout);
        }).fail(function (xhr, textStatus, errorMessage) {
            if (xhrMessages[xhr.status]){
                $errorArea.text(xhrMessages[xhr.status]);
            } else {
                $errorArea.text(errorMessage);
            }
        });
    }

    $chatForm.on("submit", (function (e) {
        e.preventDefault();
        if (addMessageStatus) {
            return;
        }
        const $messageValue = $("#message-value");
        let $messageValueData = $messageValue.val();
        if (!$messageValueData.replace(/\s+/g, "")) {
            $messageValue.val("");
            $errorArea.text("Cant send empty message");
            return;
        }
        if ($messageValueData.length > maxMessageLength) {
            $errorArea.text("Long message! Max 500 characters");
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
        $.ajax({
            type: "POST",
            url: "/dashboard/logOut",
            cache: false
        }).always(function () {
            window.location.href = location.protocol + '//' + location.host;
        });
    }

    function sendMessage(data, $messageValue) {
        addMessageStatus = true;
        $.ajax({
            type: "POST",
            url: "/dashboard/addMessage",
            data: data,
            dataType: "json",
            cache: false
        }).done(function (data, status, xhr) {
            if (xhr.status === 200){
                $messageValue.val("");
                $errorArea.text("");
            } else {
                $errorArea.text(data);
            }
            addMessageStatus = false;
            $messageValue.attr("readonly", false);
            loadMessage();
        }).fail(function (xhr, textStatus, errorMessage) {
            if (xhrMessages[xhr.status]){
                $errorArea.text(xhrMessages[xhr.status]);
            } else {
                $errorArea.text(errorMessage);
            }
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
