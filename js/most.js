jQuery(document).ready(function() {
	jQuery(".fancybox").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});	

	jQuery('.dropdown-toggle').dropdown();
});

jQuery(window).load(function(){
	jQuery('#gccalendar').css({'height': jQuery('.block-promo img').height()-50 });
});

function showForm(id)
{
	jQuery(id).show(500);	
	jQuery('.main-section').animate({scrollTop: jQuery(id).offset().top}, 1000);
}