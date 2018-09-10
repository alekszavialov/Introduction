$(document).ready(function() {
	$('.select-head').click(function(){
		$('.select').addClass('select-active');
		$('.select-items').fadeToggle( "slow" );
	});
});