var sliderInterval = 4000,
	pauseSlider = 0;

/* Ready, Set, Go. */
$(document).ready(function() {
    $('#splash').fullpage({
        sectionSelector: 'section',
		fixedElements: 'header',
        navigation: true,
		navigationPosition: 'left',
		showActiveTooltip: false,
		slidesNavigation: true,
		slidesNavPosition: 'bottom',
		controlArrows: false,
        afterRender: function () {
    		pauseSlider = setInterval( function() {
                $.fn.fullpage.moveSlideRight();
    		}, sliderInterval);
    		$('.fp-slides .slide').hover(function(ev) {
    	    	clearInterval(pauseSlider);
    		}, function(ev) {
    		    pauseSlider = setInterval( function() {
    			    $.fn.fullpage.moveSlideRight();
    		    }, sliderInterval);
        	});
        },
        afterLoad: function(anchorLink, index) {
            if ( index == 1 ) {
                $( 'body > header h1.brand' ).removeClass( 'active' );
            } else {
                $( 'body > header h1.brand' ).addClass( 'active' );
            }
        }
    });
});