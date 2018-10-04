const selectItemsArray = [
	["tile000.png", "Jenny Jess"],
	["tile001.png", "Elliot Fu"],
	["tile002.png", "Steve Feliciano"],
	["tile003.png", "Kareem Beard"],
	["tile004.png", "Emmeline Bean"],
	["tile005.png", "Guto Harris"],
	["tile006.png", "Anis Findlay"],
	["tile007.png", "Juan Poole"],
	["tile008.png", "Vikki O'Doherty"],
	];

const itemsContainer = $(".select-items");	
const itemsHead = $(".select-head");
const animationSpeed = "slow";

$(function() {	
	(function () {
		let container, image, value;
		$.each(selectItemsArray, function(key,value) {
			container = $("<li> /").addClass("select-item").appendTo(itemsContainer);
			image = $("<img />", {src :  `img/${value[0]}`, alt : `${value[1]}`}).addClass("select-image").appendTo(container);
			value = $("<span>").addClass("select-item-value").text(value[1]).appendTo(container);
		});
	})();
});

$(".select-head").click(function() {
	toggleItems();
});

function toggleItems() {
	if (!$(itemsContainer).is(':animated')) {
		$(".select").toggleClass("select-active");
		itemsContainer.fadeToggle(animationSpeed);
	}
}

itemsContainer.on("click", "li", function() {	
	$(".selected").removeClass("selected");
	$(this).addClass("selected");
	$(".select-head-selected").text($(this).text());	
	toggleItems();
});



