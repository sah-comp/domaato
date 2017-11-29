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
     * @todo Implement a cron job that deletes candidate which are older than max token Age
     *
     * @uses Flight::setting()
     * @param string $token
     * @return bool true when email was added, false when email was not added
     */
    public function confirm($token)
    {
        $candidate = R::findOne('candidate', " token = ? LIMIT 1 ", array( $token ));
        if (! $candidate) {
            $this->render('error');
            return false;
        }
        if ($age = ((time() - $candidate->stamp) / 3600) > Flight::setting()->timeframe) {
            $this->render('error');
            return false;
        }
        R::begin();
        try {
            $email = R::dispense('email');
            $email->email = $candidate->email;
            R::store($email);
            R::trash($candidate);
            R::commit();
            $this->render('success');
            return true;
        } catch (Exception $e) {
            error_log($e);
            R::rollback();
            $this->render('error');
            return false;
        }
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

        if ($email = R::findOne('email', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
            $this->emailAlreadyList();
            return false;
        }
        if ($candidate = R::findOne('candidate', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
            $this->emailAlreadyCandidate();
            return false;
        }

        $candidate = R::dispense('candidate');
        $candidate->email = $dialog[ 'email' ];
        R::begin();
        try {
            R::store($candidate);
            $candidate->sendOptinMail();
            R::commit();
        } catch (Exception $e) {
            error_log($e) ;
            R::rollback();
        }
    }

    /**
     * Renders output to tell user that the email is already on the newsletter list.
     */
    public function emailAlreadyList()
    {
        error_log('Email already on the list');
    }

    /**
     * Renders output to tell user that the email is already a candidate.
     */
    public function emailAlreadyCandidate()
    {
        error_log('Email already a candidate');
    }

    /**
     * Renders the a newsletter result page.
     *
     * @param string $message
     */
    public function render($message = 'idle')
    {
        Flight::render('domaato/newsletter/confirm', array(), 'content');
        Flight::render('domaato-simple-html5', array(
            'title' => I18n::__('domaato_newsletter_title'),
            'language' => Flight::get('language')
        ));
    }
}
