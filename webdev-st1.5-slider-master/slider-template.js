const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';
const LEFT_BUTTON_KEY = 37;
const RIGHT_BUTTON_KEY = 39;
const navigationBody = $('.slider-previews');
const bigImg = $('.slider-current img');
const IMAGES = [
	'?image=1080',
	'?image=1079',
	'?image=1069',
	'?image=1063',
	'?image=1050',
	'?image=1039'
];

$(function() {

	(function() {
		let sliderNavItem;
		let sliderNavItemImg;
		$.each(IMAGES, function(index, value) {
			sliderNavItem = $('<li/>');
			$('<img />', {
					src: `${API_URL}${SMALL_SIZE}/${value}`
				})
				.appendTo(sliderNavItem);
			sliderNavItem.appendTo(navigationBody);
		});
		navigationBody.find('li').first().addClass('current');
		bigImg.attr('src', `${API_URL}${BIG_SIZE}/${IMAGES[0]}`).fadeIn('fast');
	})();

});

navigationBody.on("click", "img", function() {
	$('.current').removeClass('current');
	$(this).closest("li").addClass('current')
	let imgSRC = $(this).attr('src').replace(`/${SMALL_SIZE}/?`, `/${BIG_SIZE}/?`);
	changeSlide(imgSRC);
});

function swipe(side) {
	if (side.length === 0) {
		side = navigationBody.find('li').first().hasClass('current') ? side = navigationBody.find('li').last() :
			side = navigationBody.find('li').first();
	}
	$('.current').removeClass('current');
	side.addClass('current');
	imgSRC = side.find('img').attr('src').replace(`/${SMALL_SIZE}/?`, `/${BIG_SIZE}/?`);;
	changeSlide(imgSRC);
}

function changeSlide(src) {
	bigImg.fadeOut('fast');
	$.when(bigImg.fadeOut('fast')).done(function() {
		bigImg.attr('src', src);
		bigImg.fadeIn('fast');
	});
}

$(document).on("keydown", function(e) {
	switch (e.keyCode) {
		case LEFT_BUTTON_KEY:
			swipe($('.current').prev());
			break;
		case RIGHT_BUTTON_KEY:
			swipe($('.current').next());
	}
});