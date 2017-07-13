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
     * Instatiate a report controller.
     *
     * A session is started and the report environment is set up.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Renders a page where users may choose or search a business to report on.
     *
     * In order to file a report
     * user must be logged in
     * otherwise user is forwarded to the login page.
     */
    public function index()
    {
        Auth::check();
        Permission::check(Flight::get('user'), 'report', 'index');
        if ( ! isset( $_SESSION['report_id'] ) ) {
            $_SESSION['report_id'] = 0;
        }
        $record = R::load('report', $_SESSION['report_id']);
		if (Flight::request()->method == 'POST') {
		    // user has choosen a object, do we know it, dont?
		    $places = array();
		} else {
            $places = Flight::get('user')->placesNearBy();
		}
        Flight::render('report/index', array(
            'title' => I18n::__('domaato_fileareport_title'),
            'language' => Flight::get('language'),
            'record' => $record,
            'places' => $places
        ));
    }
    
    /**
     * Renders a page where user writes a report on a certain business.
     *
     * @param int $person_id The id of the person bean to attach a report to
     */
    public function add( $person_id )
    {
        $person = R::load( 'person', $person_id );
        error_log('File a report about ' . $person->name);
        Auth::check();
        Permission::check(Flight::get('user'), 'report', 'add');
        if ( ! isset( $_SESSION['report_id'] ) ) {
            $_SESSION['report_id'] = 0;
        }
        $record = R::load('report', $_SESSION['report_id']);
		if (Flight::request()->method == 'POST') {
		    error_log('A new report has to be stored and attached to the person.');
        }
        Flight::render('report/add', array(
            'title' => I18n::__('domaato_fileareport_title'),
            'language' => Flight::get('language'),
            'record' => $record
        ));
    }
}
