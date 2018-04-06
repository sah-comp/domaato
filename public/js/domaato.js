/* Ready, Set, Go. */
$(document).ready(function() {

    /**
     * Prepare all autocomplete input fields
     */
    initAutocompletes();

    /**
     * The notifications section will animate a little to catch atttention by users.
     */
    $(".notification").slideDown("slow");

});

/**
 * init google maps
 */
function initMap() {
    var location = {
        lat: $("#map").data('lat'),
        lng: $("#map").data('lon')
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}
