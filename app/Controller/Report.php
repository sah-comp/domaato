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
 * Report controller.
 *
 * The report controller takes care of all things that come up when a logged user files a report.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Report extends Controller
{
    /**
     * Renders the file a report page.
     *
     * In order to file a report
     * user must be logged in
     * otherwise user is forwarded to the login page.
     *
     * A logged user may file a report.
     */
    public function index()
    {
        session_start();
        Auth::check();
        Permission::check(Flight::get('user'), 'report', 'index');
        Flight::render('report/index', array(
            'title' => I18n::__('domaato_fileareport_title'),
            'language' => Flight::get('language')
        ));
    }
}
