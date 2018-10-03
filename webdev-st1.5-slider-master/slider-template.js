const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';

const IMAGES = [
  '?image=1080', 
  '?image=1079', 
  '?image=1069', 
  '?image=1063', 
  '?image=1050',
  '?image=1039'
];

$(function(){
	
	const navigationBody = $('.slider-previews');	
	const bigImg = $('.slider-current img');
	const LEFT_BUTTON = 37;
	const RIGHT_BUTTON = 39;

	createSlider();

	function createSlider(){
		fillSlider(navigationBody, bigImg);
	}

	function fillSlider() {
		let sliderNavItem;
		let sliderNavItemImg;
		$.each(IMAGES, function(index, value){
			sliderNavItem = $('<li/>');
			sliderNavItemImg = $('<img />');
       		sliderNavItemImg.attr('src', `${API_URL}${SMALL_SIZE}/${value}`).appendTo(sliderNavItem);
       		sliderNavItem.appendTo(navigationBody);
   		});
		navigationBody.find('li').first().addClass('current');
   		bigImg.attr('src', `${API_URL}${BIG_SIZE}/${IMAGES[0]}`);
   		bigImg.fadeIn('fast');
	}

	navigationBody.on("click", "img", function(){
		$('.current').removeClass('current');
		$(this).closest("li").addClass('current')
		imgSRC = $(this).attr('src').replace(`/${SMALL_SIZE}/?`, `/${BIG_SIZE}/?`);
		changeSlide(bigImg, imgSRC);
	});

	function swipeRight(){
		let nextElement = $('.current').next();
		if (nextElement.length === 0){
			nextElement = navigationBody.find('li').first();
		}
		$('.current').removeClass('current');
		nextElement.addClass('current');
		imgSRC = nextElement.find('img').attr('src').replace(`/${SMALL_SIZE}/?`, `/${BIG_SIZE}/?`);;
		changeSlide(bigImg, imgSRC);
	}

	function swipeLeft(){
		let prevElement = $('.current').prev();
		if (prevElement.length === 0){
			prevElement = navigationBody.find('li').last();
		}
		$('.current').removeClass('current');
		prevElement.addClass('current');
		imgSRC = prevElement.find('img').attr('src').replace(`/${SMALL_SIZE}/?`, `/${BIG_SIZE}/?`);;
		changeSlide(bigImg, imgSRC);
	}

	function changeSlide(img, src){
		img.fadeOut('fast');
		$.when(img.fadeOut('fast')).done( function() {
			img.attr('src', src);
		    img.fadeIn('fast');
		} );
	}

	$(document).on("keydown", function(e) {
	    switch (e.keyCode) {
	        case LEFT_BUTTON:
	            swipeLeft();
	            break;
	        case RIGHT_BUTTON:
	            swipeRight();
	    }
	});

});
