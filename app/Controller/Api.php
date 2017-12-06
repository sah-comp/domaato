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
 * Api controller.
 *
 * @todo Implement a callback system to make sure only authorized api keys will work
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Api extends Controller
{
    /**
     * Holds the authorization state of an api call.
     *
     * @var bool
     */
    private $auth = true;

    /**
     * Check if there is a valid API key and the referrer is correct.
     *
     * @param string $apikey
     */
    public function __construct($apikey)
    {
        if (! $user = R::findOne('user', " apikey = ? LIMIT 1", array($apikey))) {
            $this->auth = false;
        }
    }

    /**
     * Returns an empty result because of unauthorized api key.
     *
     * @param bool $json
     * @return array
     */
    public function unauthorizedCall($json = true)
    {
        if (! $json) {
            return array();
        }
        Flight::json(array());
    }

    /**
     * Domaato status.
     *
     * @param bool $json defines wether to return result as JSON or array, defaults to true
     * @return array with information about domaatos status
     */
    public function status($json = true)
    {
        if (! $this->auth) {
            return $this->unauthorizedCall($json);
        }
        $result = array(
            'count' => array(
                'report' => R::count('report'),
                'customer' => R::count('person'),
                'user' => R::count('user')
            )
        );
        if (! $json) {
            return $result;
        }
        Flight::json($result);
    }
}
