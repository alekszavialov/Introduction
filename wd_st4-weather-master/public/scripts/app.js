$(function () {

    $("nav a").on("click", function (e) {
        e.stopPropagation();
        e.preventDefault();
        let currentFunction;
        if (!(currentFunction = $(this).attr('id'))) {
            return;
        }
        $("nav a.active").removeClass();
        $(this).addClass("active");
        loadData(currentFunction);
    });

    function loadData(currentFunction) {
        $ajax(currentFunction)
            .done(function (data) {
                console.log(data);
                console.log("error!");
            })
            .fail(function (data) {
                console.log("error!");
            })
    }

    function $ajax(data, method = "GET", dataType = "json") {
        return $.ajax({
            url: "../handler/handler.php",
            method: method,
            data: {
                function: data
            },
            dataType: dataType
        });
    }

});