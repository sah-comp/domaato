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
     * Domaato splash page.
     *
     * @return void
     */
    public function index()
    {
        $this->render();
        return NULL;
    }

    /**
     * Renders the Domaato page.
     */
    public function render()
    {
        Flight::render('domaato/splash', array(), 'content');
        Flight::render('domaato-html5', array(
            'title' => I18n::__('domaato_splash_title'),
            'language' => Flight::get('language'),
            'header' => NULL,
            'navigation' => NULL,
            'footer' => NULL,
            'javascripts' => NULL
        ));
    }
}
