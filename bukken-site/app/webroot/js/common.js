$(function() {
	$('.menu-wrapper > div').tile();
	$('.floating-widget').floatingWidget();

	$('.return-to-top').on('click', function(event) {
		$('body, html').animate(
			{
				scrollTop: 0
			},
			500
		);
		return false;
	});
});