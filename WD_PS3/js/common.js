$(function() {
	let selectItemsArray = [
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
	addItems(selectItemsArray);
	$('.select-item').click(function() {
		$(this).parent().find('div.selected').removeClass('selected');
		$(this).addClass('selected');
		$('.select-selected').text($(this).text());	
		$('.select').blur();
	});
});

// $('.select-head').click(function(){
// 	$('.select').toggleClass('select-active').focus();
// 	$('.select-items').fadeToggle( "slow" );
// });

$('.select-head').on({
	click: function () {
		$('.select').toggleClass('select-active');
		$('.select-items').fadeToggle( "slow" ); 		
	}
});

$('.select').on('focusout', function () {
	$('.select-items').fadeToggle( "slow" ); 
	$('.select-active').toggleClass('select-active');
});

function addItems(items){
	let container, image, value;
	$.each(items, function(key,value) {
		container = $("<div>").addClass('select-item').appendTo('.select-items');
		image = $("<img>").addClass('select-image').attr({src :  "img/" + value[0], alt : value[1]}).appendTo(container);
		value = $("<span>").addClass('select-item-value').text(value[1]).appendTo(container);
	});
};

