$(function () {

    const minNameLength = 4;
    const maxNameLength = 20;
    const minPassLength = 6;
    const maxPassLength = 16;
    const loginReg = /([^\w\d-_])/;
    const passwordReg = /([^\w\d])/;
    const $loginForm = $("#loginForm");
    const $errorArea = $(".errorArea");
    const loger = new Loger();

    $loginForm.on("submit", (function (e) {
        e.preventDefault();
        let functionName = "formSubmit";
        const userName = $("input[name=user]").val();
        const userPassword = $("input[name=password]").val();
        if (isEmpty(userName) || isEmpty(userPassword)) {
            let error = "Empty user name or password!";
            $errorArea.text(error);
            loger.addLog(functionName, 'fail', error);
            return;
        }
        if (userName.length < minNameLength ||
            userName.length > maxNameLength ||
            loginReg.exec(userName)) {
            let error = "Name should exist 4 character at least or incorrect symbols!";
            $errorArea.text(error);
            loger.addLog(functionName, 'fail', error);
            return;
        }
        if (userPassword.length < minPassLength ||
            userPassword.length > maxPassLength ||
            passwordReg.exec(userPassword)) {
            let error = "Password should exist 6 character at least or incorrect symbols!";
            $errorArea.text("Password should exist 6 character at least or incorrect symbols!");
            loger.addLog(functionName, 'fail', error);
            return;
        }
        const data = $loginForm.serialize();
        logIn(data);
    }));

    function logIn(data) {
        let functionName = "logIn";
        $.ajax({
            type: "POST",
            url: "/dashboard/logIn",
            data: data,
            dataType: "json",
            cache: false
        }).done(function (response) {
            loger.addLog(functionName, 'done', response);
            window.location.href = response;
        }).fail(function (xhr) {
            $errorArea.text(xhr.responseText);
            loger.addLog(functionName, 'fail', xhr.responseText);
        });
    }

    function isEmpty(data) {
        return !data.replace(/\s+/g, "");
    }

});