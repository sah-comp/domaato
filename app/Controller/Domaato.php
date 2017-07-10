<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Domaato controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Domaato extends Controller
{
    /**
     * Renders the Domaato page.
     */
    public function index()
    {
        Flight::render('domaato/index_' . Flight::get('language'), array(
            'title' => I18n::__('domaato_index_title'),
            'language' => Flight::get('language')
        ));
    }
}
