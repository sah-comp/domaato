/**
 * Index of start slide.
 */
slide_index_start = 1;

/**
 * Index of slide with counters.
 */
slide_index_counters = 4;

/**
 * Api Url for status
 */
apiUrlStatus = 'http://domaato.test/api/52fa2902eaad05b96cc35b750c2d635d8c9d4bc7/status';

/**
 * Amount of milliseconds a slide of Fullpage.js is shown.
 */
var sliderInterval = 4000;

/**
 * Holds the interval for pausing a slider when mouse is hovering over the slide.
 */
var pauseSlider = null;

/**
 * Holds the status if counters have already been counted up.
 */
var countCounted = false;

/**
 * Number of seconds to count up the counters.
 */
var countUpInterval = 1;

/**
 * Holds the interval for refreshing the counters.
 */
var countCountInterval = null;

/**
 * Amount of milliseconds to refresh the counters with values from Domaato status.
 */
var countInterval = 1000;

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
     * Using Fullpage.js to make this a one-page website.
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
        afterRender: function() {

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
             * Form with class ajaxed will be ajaxified by jQuery form plugin and
             * the response is placed into the element given in data-container.
             */
            $(document).on('submit', '.ajaxed', function(event) {
                event.preventDefault();
                var form = $(this);
                var container = form.data("container");
                var empty_before_append = form.data("emptybeforeappend");
                var btn = $('input[type=submit]', form);
                btn.addClass('processing');
                btn.attr('disabled', true);
                form.ajaxSubmit({
                    success: function(response) {
                        btn.removeClass('processing');
                        btn.removeAttr('disabled');
                        //alert( 'Success: Made roundtrip to server and back.' );
                        if (empty_before_append == 'yes') {
                            $("#" + container).empty().append(response);
                        } else {
                            $("#" + container).append(response);
                        }
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
            pauseSlider = setInterval(function() {
                $.fn.fullpage.moveSlideRight();
            }, sliderInterval);
            $('.fp-slides .slide .fp-tableCell').hover(function(ev) {
                clearInterval(pauseSlider);
            }, function(ev) {
                pauseSlider = setInterval(function() {
                    $.fn.fullpage.moveSlideRight();
                }, sliderInterval);
            });
        },
        afterLoad: function(anchorLink, index) {
            /**
             * When the first section is active no logo is shown in the header.
             */
            if (index == slide_index_start) {
                $('body > header h1.brand').removeClass('active');
            } else {
                $('body > header h1.brand').addClass('active');
            }

            /**
             * On the third section counters are counting up, if that not already happened.
             *
             * @see https://inorganik.github.io/countUp.js/
             */
            if (!countCounted && index == slide_index_counters) {
                countCounted = true;
                var countReport = new CountUp('count-report', 0, $('#count-report').data('target'), 0, countUpInterval, countOptions);
                countReport.start();
                var countCompany = new CountUp('count-company', 0, $('#count-company').data('target'), 0, countUpInterval, countOptions);
                countCompany.start();
                var countUser = new CountUp('count-user', 0, $('#count-user').data('target'), 0, countUpInterval, countOptions);
                countUser.start();

                /**
                 * In a certain interval update the counters in section facts.
                 *
                 * To get the latest status information from the domaato database we
                 * call the API with our API key and use the status information to
                 * retrieve JSON data.
                 */
                var countCountInterval = setInterval(function() {
                    $.get(apiUrlStatus, function(data) {
                        countReport.update(data.count.report);
                        countCompany.update(data.count.customer);
                        countUser.update(data.count.user);
                    }, 'json');
                }, countInterval);

            }

        }
    });

});
