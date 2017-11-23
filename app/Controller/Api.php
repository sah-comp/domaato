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
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Api extends Controller
{
  /**
   * Domaato status.
   *
   * @param bool $json defines wether to return result as JSON or array, defaults to TRUE
   * @return array with information about domaatos status
   */
  public static function status( $json = TRUE )
  {
    $result = array(
      'count' => array(
        'report' => R::count( 'report' ),
        'customer' => R::count( 'person' ),
        'user' => R::count( 'user' )
      )
    );
    if ( ! $json) return $result;
    Flight::json( $result );
  }
}
