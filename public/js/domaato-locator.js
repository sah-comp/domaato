/* Ready, Set, Go. */
$(document).ready(function() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(copyPositionToDialog);
    } else {
        // bounce her on your knees
    }

});

/**
 * Copies the latitude and longitued to the hidden fields lat and lon of the login dialog.
 *
 * @param object position from geolocation.getCurrentPosition
 * @return void
 */
function copyPositionToDialog(position) {
    $('#domaato-lat').val(position.coords.latitude); 
    $('#domaato-lon').val(position.coords.longitude);
    return true;
}