const icons = {
    "sun": "002-sun",
    "rain": "003-rain",
    "flash": "001-flash",
    "sky": "005-sky",
    "sky-1": "004-sky-1"
};

const imgPath = "img/icons/";

$(function () {

    const $nowBlock = $(".container .now");
    const $forecast = $(".forecast");

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

    function fillHead(data, city) {
        $("<div/>", {"class": "all-50"}).append(
            $("<div/>", {"class": "city-name", text: city}),
            $("<div/>", {"class": "date", text: `${convertDate(data.date)}`}),
            $("<div/>", {"class": "current-temperature", html: `${data.temperature} &deg`}),
        ).appendTo($nowBlock);
        $("<div/>", {"class": "all-50"}).append(
            createSvgBlock("weather-icon", data.icon)
        ).appendTo($nowBlock);
    }

    function loadData(currentFunction) {
        $ajax(currentFunction)
            .done(function (data) {
                $forecast.empty();
                $nowBlock.empty();
                console.log(data);
                fillHead(data[0], data["city"]);
                $.each(data, function (index, element) {
                    if (index > 0)
                        fillData(element);
                });
            })
            .fail(function (data) {
                console.log("error!");
            })
    }

    function $ajax(data) {
        return $.ajax({
            url: "../handler/handler.php",
            method: "GET",
            data: {
                function: data
            },
            dataType: "json"
        });
    }

    function convertTime(date) {
        return new Date(date).toLocaleTimeString('en-GB', {hour: '2-digit', minute: '2-digit'});
    }

    function convertDate(date) {
        return new Date(date).toLocaleDateString('en-GB', {weekday: 'long', month: '2-digit', day: '2-digit'});
    }

    function createSvgBlock(blockClassName, iconName) {
        return $("<div/>", {"class": blockClassName}).load(`${imgPath}${icons[iconName]}.svg`, function () {
            $(this).find("svg").css("fill", "#fff");
        });
    }

    function fillData(data) {
        $("<div/>", {"class": "hourly-forecast clearfix"}).append(
            $("<div/>", {"class": "forecast-date", text: `${convertTime(data.date)}`})
        ).append(
            $("<div/>", {"class": "forecast-weather"}).append(
                $("<div/>", {"class": "forecast-temperature", html: `${data.temperature} &deg`}),
                createSvgBlock("forecast-icon", data.icon)
            )
        ).appendTo($forecast);
    }

    $("nav a#json").trigger("click");

});