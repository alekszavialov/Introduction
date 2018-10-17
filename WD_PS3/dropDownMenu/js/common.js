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

const animationSpeed = "slow";

$(function() { 

	const $itemsContainer = $(".select-items");	
	const $itemsHead = $(".select-head");

	let container;
	$.each(selectItemsArray, function(key,value) {
		container = $("<li> /").addClass("select-item").appendTo($itemsContainer);
		$("<img />", {src :  `img/${value[0]}`, alt : `${value[1]}`}).addClass("select-image").appendTo(container);
		$("<span>").addClass("select-item-value").text(value[1]).appendTo(container);
	});

	$itemsHead.click(function() {
		toggleItems();
	});

	function toggleItems() {
		if (!$($itemsContainer).is(':animated')) {
			$(".select").toggleClass("select-active");
			$itemsContainer.slideToggle(animationSpeed);
		}
	}

	$itemsContainer.on("click", "li", function() {	
		if (!$($itemsContainer).is(':animated')) {
			const $selectedImg = $(this).find('img');
			$(".selected").removeClass("selected");
			$(this).addClass("selected");
			$(".select-head-selected").text($(this).text());	
			$(".select-head-image").attr({
				src: $selectedImg.attr('src'),
				alt: $selectedImg.attr('alt')
			});
			toggleItems();
		}
	});

	$("body").click(function(event) {
		if(event.target.className !== "select" && $('.select').hasClass('select-active')){
			toggleItems();
		}
	});
});	








