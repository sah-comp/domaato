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

        $user = R::findOne('user', " hash = :hash LIMIT 1", [':hash' => $hash]);
 
        //Finds all the reports of the specific user

        $this->records = R::findAll('report',"user_id=?", [Flight::get('user')->getId()]);
        
        //Pass the records to the view
        $this->render();
    }

    /**
     * Renders the profile page.
     */
   public function render() {
    Flight::render('shared/notification', array(), 'notification');
    //
    Flight::render('shared/navigation/account', array(), 'navigation_account');
    Flight::render('shared/navigation/main', array(), 'navigation_main');
    Flight::render('shared/navigation', array(), 'navigation');
    // Flight::render('account/toolbar', array(), 'toolbar');
    Flight::render('shared/header', array(), 'header');
    Flight::render('shared/footer', array(), 'footer');
    Flight::render($this->template, array(
        'record' => Flight::get('user'),
        'records'=> $this->records
    ), 'content');   
    Flight::render('html5', array(
        'title' => I18n::__("account_head_title"),
        'language' => Flight::get('language')
    ));

}


}

 
