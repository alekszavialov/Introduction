$(function () {

    const minNameLength = 4;
    const maxNameLength = 20;
    const minPassLength = 6;
    const maxPassLength = 16;
    const loginReg = /([^\w\d-_])/;
    const passwordReg = /([^\w\d])/;
    const $loginForm = $("#loginForm");
    const $errorArea = $(".errorArea");

    $loginForm.on("submit", (function (e) {
        e.preventDefault();
        const userName = $("input[name=user]").val();
        const userPassword = $("input[name=password]").val();
        if (isEmpty(userName) || isEmpty(userPassword)) {
            $errorArea.text("Empty user name or password!");
            return;
        }
        if (userName.length < minNameLength ||
            userName.length > maxNameLength ||
            loginReg.exec(userName)) {
            $errorArea.text("Name should exist 4 character at least or incorrect symbols!");
            return;
        }
        if (userPassword.length < minPassLength ||
            userPassword.length > maxPassLength ||
            passwordReg.exec(userPassword)) {
            $errorArea.text("Password should exist 6 character at least or incorrect symbols!");
            return;
        }
        const data = $loginForm.serialize();
        logIn(data);
    }));

    function logIn(data) {
        $.ajax({
            type: "POST",
            url: "/dashboard/logIn",
            data: data,
            dataType: "json",
            cache: false
        }).done(function (response) {
            window.location.href = response;
        }).fail(function (xhr) {
            $errorArea.text(xhr.responseText);
        });
    }

    function isEmpty(data) {
        return !data.replace(/\s+/g, "");
    }

});