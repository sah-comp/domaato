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
 * Report controller.
 *
 * The report controller takes care of all things that come up when a logged user files a report.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Report extends Controller_Scaffold
{
    /**
     * Container for javascripts to load.
     *
     * @var array
     */
    public $javascripts = array(
    );

    /**
     * Instatiate a report controller.
     *
     * A session is started and the report environment is set up.
     */
    public function __construct()
    {
        session_start();
        Auth::check();
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
        Permission::check(Flight::get('user'), 'report', 'index');
        if ( ! isset( $_SESSION['locus_id'] ) ) {
            $_SESSION['locus_id'] = 0;
        }
        $this->record = R::load('locus', $_SESSION['locus_id']);
		if (Flight::request()->method == 'POST') {
            $this->record = R::graph( Flight::request()->data->dialog, TRUE );
            $this->record->user = Flight::get('user');
		    $this->records = R::find( 'person', ' name LIKE :name ', array(
		        ':name' => $this->record->searchtext . '%'
		    ));
            R::begin();
            try {
                R::store($this->record);
                R::commit();
                //$this->notifyAbout('success');
            }
            catch (Exception $e) {
                error_log($e);
                R::rollback();
                //$this->notifyAbout('error');
            }
		} else {
            $this->records = Flight::get('user')->placesNearBy();
		}
		$this->layout = 'index';
		$this->render();
    }
    
    /**
     * Renders a page where user writes a report on a certain business.
     *
     * @param int $person_id The id of the person bean to attach a report to
     */
    public function add( $person_id )
    {
        $this->action = 'add';
        $person = R::load( 'person', $person_id );
        Permission::check(Flight::get('user'), 'report', 'add');
        if ( ! isset( $_SESSION['report_id'] ) ) {
            $_SESSION['report_id'] = 0;
        }
        $this->record = R::load('report', $_SESSION['report_id']);
		if (Flight::request()->method == 'POST') {
            $this->record = R::graph( Flight::request()->data->dialog, TRUE );
            $this->record->person = $person;
            $this->record->user = Flight::get('user');
            R::begin();
            try {
                R::store($this->record);
                R::commit();
                $this->notifyAbout('success');
                $this->redirect("/file-a-report");
            }
            catch (Exception $e) {
                error_log($e);
                R::rollback();
                $this->notifyAbout('error');
            }
        }
		$this->layout = 'add';        
        $this->render();
    }

    /**
     * Renders a domaato report page.
     */
    public function render()
    {
	    Flight::render('domaato/shared/notification', array(
	       'record' => $this->record
	    ), 'notification');
	    //
        Flight::render('domaato/shared/navigation/account', array(), 'navigation_account');
		Flight::render('domaato/shared/navigation/main', array(), 'navigation_main');
        Flight::render('domaato/shared/navigation', array(), 'navigation');
		Flight::render('domaato/shared/header', array(), 'header');
		Flight::render('domaato/shared/footer', array(
		    'pagination' => $this->pagination
		), 'footer');
		Flight::render('report/' . $this->layout, array(
            'record' => $this->record,
            'records' => $this->records
		), 'content');
        Flight::render('domaato-html5', array(
            'title' => 'title',
            'language' => Flight::get('language'),
            'javascripts' => $this->javascripts
        ));
    }
}
