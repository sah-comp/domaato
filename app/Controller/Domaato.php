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
 * Domaato controller.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Domaato extends Controller
{
    /**
     * Construct a new Domaato.
     *
     * Start a session and check for a logged user.
     */
    public function __construct()
    {
        session_start();
        Auth::validate();
    }

    /**
     * Domaato splash page.
     *
     * @return void
     */
    public function index()
    {
        $this->render();
        return null;
    }

    /**
     * Renders the Domaato page.
     */
    public function render()
    {
        Flight::render('domaato/splash', array(), 'content');
        Flight::render('domaato-website-html5', array(
            'title' => I18n::__('domaato_splash_title'),
            'language' => Flight::get('language'),
            'header' => null,
            'navigation' => null,
            'footer' => null,
            'javascripts' => null
        ));
    }
}
