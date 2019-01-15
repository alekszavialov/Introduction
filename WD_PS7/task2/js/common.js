$(function () {

    const $form = $("#mainForm");
    const $input = $("#input");
    const $text = $("#text");




    $form.on("submit", (function (e) {
        e.preventDefault();
        const text = $('<div/>').text($text.val()).html();
        const inputRegex = /^\/(?<regex>.*)\/(?<flags>\w*)?$/;
        const inputText = inputRegex.exec($input.val());

        console.log(text);
        console.log(inputText.groups.flags);
        const regex = new RegExp(inputText.groups.regex, inputText.groups.flags);

        let newString = text.replace(regex, function(p) {
            return `<mark>${p}</mark>`;
        });
        $('#test').empty().append(newString);

    }));


});