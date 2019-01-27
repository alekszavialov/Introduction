$(function () {

    const $form = $("#mainForm");

    const regEx = {
        ip: /^(?:(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])\.){3}(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])$/,
        url: /^(?:https?:\/\/)[\w.-]+(?:\.[\w.-]+)+[\w\-._~:\/?#[\]@!$&'()*+,;=]+$/i,
        email: /^[a-z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)*$/i,
        date: /^(?:0[0-9]|1[0-2])\/(?:[0-2][0-9]|3[0-1])\/[0-9]{4}$/,
        time: /^(?:[0-1][1-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/
    };

    $form.on("change", "input", function () {
        validationData($(this).attr("name"), $(this).val());
    });

    $form.on("submit", (function (e) {
        e.preventDefault();
        let errorCount = 0;
        $("#" + $form.attr("id") + " input").each(function () {
            if (false === validationData($(this).attr("name"), $(this).val())) {
                errorCount++;
            }
        });
        if (errorCount !== 0) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "../handler/handler.php",
            data: {
                data: $form.serializeArray()
            },
            dataType: 'json',
            cache: false
        }).done(function (response) {
            $.each(response, function (name, value) {
                validationData(name, value);
            });
        }).fail(function (xhr) {
            console.log(xhr.responseText);
        });
    }));

    function validationData(name, value) {
        const $answerField = $("#" + name + "Response");
        const $currentInput = $("#" + name + "Input");
        if (regEx[name].test(value)) {
            $answerField.text('true');
            $currentInput.removeClass('fail').addClass('done');
            return true;
        }
        $answerField.text('false');
        $currentInput.removeClass('done').addClass('fail');
        return false;
    }
});