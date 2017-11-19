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
 * Newsletter controller.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Newsletter extends Controller
{
    /**
     * Tries to confirm a candidate email address.
     *
     * @param string $token
     */
    public function confirm( $token )
    {
        $candidate = R::findOne( 'candidate', " token = ? LIMIT 1 ", array( $token ));
        error_log( $candidate->email . ' wants to confirm' );
    }

    /**
     * Opt-in.
     */
    public function optin()
    {
        $dialog = Flight::request()->data->dialog;
        $candidate = R::dispense( 'candidate' );
        $candidate->email = $dialog[ 'email' ];
        R::begin();
        try {
            R::store( $candidate );
            $candidate->broadcast();
            R::commit();
        } catch ( Exception $e ) {
            error_log($e);
            R::rollback();
        }
    }
}
