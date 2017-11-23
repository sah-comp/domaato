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
     *
     * This will check if the e-mail address was not already registered for newsletters
     * and if there is not already a optin cycle pending.
     *
     * @uses emailAlreadyListed()
     * @uses emailAlreadyCandidate()
     */
    public function optin()
    {
        $dialog = Flight::request()->data->dialog;

        if ( $email = R::findOne( 'email', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
          return $this->emailAlreadyList();
        }
        if ( $candidate = R::findOne( 'candidate', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
          return $this->emailAlreadyCandidate();
        }

        $candidate = R::dispense( 'candidate' );
        $candidate->email = $dialog[ 'email' ];
        R::begin();
        try {
            R::store( $candidate );
            $candidate->sendOptinMail();
            R::commit();
        } catch ( Exception $e ) {
            error_log( $e) ;
            R::rollback();
        }
    }

    /**
     * Renders output to tell user that the email is already on the newsletter list.
     */
    public function emailAlreadyList()
    {
      error_log( 'Email already on the list' );
    }

    /**
     * Renders output to tell user that the email is already a candidate.
     */
    public function emailAlreadyCandidate()
    {
      error_log( 'Email already a candidate' );
    }
}
