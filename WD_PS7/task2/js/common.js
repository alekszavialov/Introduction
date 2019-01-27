$(function () {

    const $mainForm = $("#mainForm");
    const $regexInput = $("#regexInput");
    const $textarea = $("#text");
    const $refurbishedText = $("#refurbishedText");

    $mainForm.on("submit", (function (e) {
        e.preventDefault();
        const textareaText = $('<div/>').text($textarea.val()).html();
        const inputRegex = /^\/(?<regex>.*)\/(?![gmixXsuUAJD]*([gmixXsuUAJD])[gmixXsuUAJD]*\2)(?<flags>[gmixXsuUAJD]{0,11})$/;
        const regexGroups = inputRegex.exec($regexInput.val());
        if (!regexGroups || !textareaText){
            $refurbishedText.empty().text('Incorrect regex or empty text!');
            return;
        }
        const regex = new RegExp(regexGroups.groups.regex, regexGroups.groups.flags);
        let refurbishedString = textareaText.replace(regex, function (text) {
            return `<mark>${text}</mark>`;
        });
        $refurbishedText.empty().html(refurbishedString);
    }));

    function stringToColour (str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            hash = str.charCodeAt(i) + ((hash << 5) - hash);
        }
        let colour = '#';
        for (let i = 0; i < 3; i++) {
            let value = (hash >> (i * 8)) & 0xFF;
            colour += ('00' + value.toString(16)).substr(-2);
        }
        return colour;
    }

});