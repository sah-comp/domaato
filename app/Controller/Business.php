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
 * Business controller.
 *
 * The business controller takes care of all things that come up when a logged user reviews a biz.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Business extends Controller
{
    /**
     * Container for javascripts to load.
     *
     * @var array
     */
    public $javascripts = array(
    );

    /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();

    /**
     * Holds a instance of a Pagination class.
     *
     * @var Pagination
     */
    public $pagination;

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
     * Renders a page to view a business (person bean).
     *
     * @param int $id The id of the person bean to load
     */
    public function index($id)
    {
        //Permission::check(Flight::get('user'), 'business', 'index');
        $this->record = R::load('person', $id);
        $this->layout = 'index';
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
        Flight::render('business/' . $this->layout, array(
            'language' => Flight::get('language'),
            'record' => $this->record,
            'records' => $this->records
        ), 'content');
        Flight::render('domaato-html5', array(
            'page_id' => 'business',
            'title' => 'title',
            'language' => Flight::get('language'),
            'javascripts' => $this->javascripts
        ));
    }
}
