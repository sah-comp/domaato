<?php
/**
 * Domaato.
 *
 * @package Cinnebar
 * @package Domaato
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Profile controller.
 * @package Cinnebar
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Profile extends Controller
{
    /**
     * Container for javascripts to load.
     *
     * @var array
     */
    public $stylesheets = array(
        'bootstrap'
    ); 
    /**
     * Holds the template to render.
     *
     * @var string
     */
    public $template;

     /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();

     /**
     * Holds a instance of the bean to handle.
     *
     * @var RedBean_OODBBean
     */
    public $record;
  
    /**
     * Checks if the URL for the profile is NULL, redirects to the current user hash if logged in.
     * If not logged in redirects to the login page
     * If specified the hash shows the desired user profile page
     * 
     * @param string $hash
     */
    public function index ($hash = null)
    {
        $this->template = 'profile/index';
        if ($hash === null) {
            session_start();
            Auth::check();
            $hash = Flight::get('user')->hash;
        } 

        //Find the hash code of the specific user to pass to the route if user not logged in

        $this->record = R::findOne('user', " hash = :hash LIMIT 1", [':hash' => $hash]);
        
       /* echo '<pre>';
        echo var_dump ( $this->record );
        echo '<pre>';*/
        //Finds all the reports of the specific user

        $this->records = R::findAll('report',"user_id=?", [$this->record->id]);
        
        /* 
            [Flight::get('user')->getId()]
        */
        
        //Pass the records to the view

        $this->render();
    }

    /**
     * Edits the profile page 
     * 
     * 
     */

    public function edit() {
        $this->template = 'profile/edit';
        
        $this->render();
    }


    /**
     * Renders the profile page.
     */

   public function render() {

    Flight::render('domaato/shared/notification', array(
        'record' => $this->record
     ), 'notification');
     //
     Flight::render('domaato/shared/navigation/account', array(), 'navigation_account');
     Flight::render('domaato/shared/navigation/main', array(), 'navigation_main');
     Flight::render('domaato/shared/navigation', array(), 'navigation');
     Flight::render('domaato/shared/navigation2', array(), 'navigation2');
     Flight::render('domaato/shared/header', array(), 'header');
     Flight::render('domaato/shared/footer', array(
     ), 'footer');
     Flight::render($this->template, array(
         'language' => Flight::get('language'),
         'record' => $this->record,
         'records' => $this->records
     ), 'content');
     Flight::render('domaato-html5', array(
         'page_id' => 'file-a-report',
         'title' => I18n::__('domaato_report_'),
         'language' => Flight::get('language')
     ));



}


}

 
