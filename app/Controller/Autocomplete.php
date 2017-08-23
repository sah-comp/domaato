<?php
/**
 * Domaato.
 *
 * @package Domaato
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Clairvoyant controller.
 *
 * This controller is a co-worker to jquery autocompelete.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Autocomplete extends Controller
{
    /*
     * Lookup term of jQuery autocomplete requests and returns results json encoded.
     *
     * @param string $type The bean type to search
     * @param string (optional) $query The prepared query, aka. SQL
     * @return string $jsonEncodedArray JSON encoded response
     */
    public function autocomplete($type, $query = 'default')
    {
        $bean = R::dispense($type);
        $result = $bean->clairvoyant( Flight::request()->query->term, $query );
        Flight::jsonp( $result, 'callback' );
    }
}
