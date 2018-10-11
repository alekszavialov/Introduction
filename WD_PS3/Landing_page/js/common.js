$("#show-form").click(function() {
	$("#phone-form").removeClass("hidden");
});

$("#phone-form-close").click(function() {
	$("#phone-form").addClass("hidden");
});

$(".up-page").click(function() {
	$("html").animate({
		scrollTop: 0
	}, "slow");
});

$(document).scroll(function() {
	const minScroll = 10;
	const scroll = $(this).scrollTop() > minScroll;
	const $upPage = $(".up-page");
	if (scroll && $upPage.hasClass("hidden")) {
		$upPage.removeClass("hidden");
	} else if (!scroll && !$upPage.hasClass("hidden")) {
		$upPage.addClass("hidden");
	}
});

$('a[href^="#"]').click(function(event) {
	event.preventDefault();
	const $element = $($.attr(this, 'href'))
	const elOffset = $element.offset().top;
	const elHeight = $element.height();
	const windowHeight = $(window).height();
	const animationSpeed = 500;
	let offset = elOffset;
	if (elHeight < windowHeight && elOffset > windowHeight / 2) {
		offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
	}
	$('html').animate({
		scrollTop: offset
	}, animationSpeed);
});