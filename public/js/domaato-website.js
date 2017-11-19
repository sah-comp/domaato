/**
 * Set up timings and semaphores.
 */
var sliderInterval = 4000;
var pauseSlider = 0;
var countCounted = false;

/**
 * Options countUp
 */
var countOptions = {
    useEasing: true,
    useGrouping: true,
    separator: '.',
    decimal: ','
};

/* Ready, Set, Go. */
$(document).ready(function() {
    
    /**
     * Make it a one page website.
     */
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
            /**
             * All links with class nextSlide will scroll one section down.
             */
            $('.nextSlide').on('click', function(event) {
                event.preventDefault();
                $.fn.fullpage.moveSectionDown();
                return false;
            });
            
            /**
             * Clicking the header brand will bring you back to section 1, aka. home.
             */
            $('body > header h1 a').on('click', function(event) {
                event.preventDefault();
                $.fn.fullpage.moveTo(1);
                return false;
            });
            
        	/**
        	 * Form with class inplace will be ajaxified by jQuery form plugin and
        	 * the response is placed into the element given in data-container.
        	 */
            $(document).on( 'submit', '.ajaxed', function(event) {
                event.preventDefault();
                var form = $(this);
                var container = form.data("container");
                var btn = $( 'input[type=submit]', form);
                //btn.attr( 'clicked', true );
                btn.addClass( 'processing' );
                btn.attr( 'disabled', true );
                form.ajaxSubmit({
                    success: function(response) {
                        btn.removeClass( 'processing' );
                        //btn.removeAttr( 'clicked' );
                        btn.removeAttr( 'disabled' );
                        //alert( 'You have opted in!' );
                        /*$("#"+container).empty().append(response);*/
                    }
                });
                return false;
            });
            
            /**
             * Add attribute clicked when clicked.
             */
            /*
            $('form.ajaxed input[type=submit]').on( 'click', function () {
                $('input[type=submit]', $(this).parents('form')).removeAttr('clicked');
                $(this).attr('clicked', true);
            });
            */
            
            /**
             * Make submit button disabled after clicking it, so form can only be send once.
             */
            /*
            $('form.ajaxed').on( 'submit', function( event ) {
                var btn = $('input[type=submit][clicked=true]');
                btn.addClass('processing');
                btn.attr('disabled', 'disabled');
                $('.notification').hide();
                return true;
            });
            */

            /**
             * Init interval for slides and add stopping on mouse over situation.
             */
    		pauseSlider = setInterval( function() {
                $.fn.fullpage.moveSlideRight();
    		}, sliderInterval);
    		$('.fp-slides .slide .fp-tableCell').hover(function(ev) {
    	    	clearInterval(pauseSlider);
    		}, function(ev) {
    		    pauseSlider = setInterval( function() {
    			    $.fn.fullpage.moveSlideRight();
    		    }, sliderInterval);
        	});
        },
        afterLoad: function(anchorLink, index) {
            /**
             * When the first section is active no logo is show in the header.
             */
            if ( index == 1 ) {
                $( 'body > header h1.brand' ).removeClass( 'active' );
            } else {
                $( 'body > header h1.brand' ).addClass( 'active' );
            }
            
            /**
             * On the third section count count has a feast, if not already he counted.
             */
            if ( ! countCounted && index == 3 ) {
                countCounted = true;
                var countReport = new CountUp( 'count-report', 0, $( '#count-report' ).data( 'target' ), 0, 1, countOptions);
                countReport.start();
                var countCompany = new CountUp( 'count-company', 0, $( '#count-company' ).data( 'target' ), 0, 1, countOptions);
                countCompany.start();
                var countVote = new CountUp( 'count-vote', 0, $( '#count-vote' ).data( 'target' ), 0, 1, countOptions);
                countVote.start();
            }
            
        }
    });
    
});