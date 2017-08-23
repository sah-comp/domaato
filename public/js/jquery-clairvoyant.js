/**
 * For each element that has class autocomplete setup a jQuery.ui autocomplete widget
 * that will call a data-source to find items and, if selected copies the selected items
 * attributes to html elements defined in data-spread.
 * You should add parameter callback=? to your source urls to allow JSONP result.
 *
 * @todo refactor code so that later added .autocomplete elements will also profit
 * @uses dispatchValues()
 */
function initAutocompletes() {
    $('.autocomplete').each(function(index, element) {
        var spread = $(this).attr('data-spread'); // holds key/value array with ids and item attrs
        $(this).autocomplete({
            'minLength': 2,
            'autoFocus': false,
            'delay': 500,
            'source': $(this).attr('data-source'),
            focus: function( event, ui) {
                dispatchValues(spread, ui);
                return false;
            },
            select: function( event, ui ) {
                dispatchValues(spread, ui);
                return false;
            }
        });
    });
}

/**
 * Copies ui.item.[property] to a element targetted by the elements id.
 */
function dispatchValues(spread, ui) {
    var fields = jQuery.parseJSON(spread);
	for (var key in fields) {
	  if (fields.hasOwnProperty(key)) {
		var value = ui.item[fields[key]];
		$('#'+key).val(value);
	  }
	}
}
