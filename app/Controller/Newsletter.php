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
     * Tries to confirm a candidate email address and renders a page.
     *
     * @todo Implement a cron job that deletes candidate beans which are older than max token Age
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
     * This will check wether the email is already a candidate or is already
     * on the mailing. If not, it will send out an email with the url to validate
     * the email address.
     *
     * @return bool
     */
    public function optin()
    {
        $dialog = Flight::request()->data->dialog;

        if ($email = R::findOne('email', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
            Flight::render('domaato/newsletter/optin/alreadylisted');
            return false;
        }
        if ($candidate = R::findOne('candidate', " email = ? LIMIT 1 ", array( $dialog[ 'email' ]))) {
            Flight::render('domaato/newsletter/optin/alreadycandidate');
            return false;
        }

        $candidate = R::dispense('candidate');
        $candidate->email = $dialog[ 'email' ];
        R::begin();
        try {
            R::store($candidate);
            $candidate->sendOptinMail();
            R::commit();
            Flight::render('domaato/newsletter/optin/success');
            return true;
        } catch (Exception $e) {
            error_log($e);
            R::rollback();
            Flight::render('domaato/newsletter/optin/error');
            return false;
        }
        return false;
    }

    /**
     * Renders the a (full) newsletter result page.
     *
     * @param string $message
     */
    public function render($message = 'idle')
    {
        Flight::render('domaato/newsletter/confirm/' . $message, array(), 'content');
        Flight::render('domaato-simple-html5', array(
            'title' => I18n::__('domaato_newsletter_title'),
            'language' => Flight::get('language')
        ));
    }
}
