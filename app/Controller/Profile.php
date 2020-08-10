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
 *
 * @package Cinnebar
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Profile extends Controller
{
    /**
     * Container for stylesheets to load.
     *
     * @var array
     */
    public $stylesheets = array(
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
    public $records = [];

    /**
    * Holds a instance of the bean to handle.
    *
    * @var RedBean_OODBBean
    */
    public $record;

    /**
     * Holds the current page.
     *
     * @var int
     */
    public $page = 1;

    /**
     * Holds an instance of a Pagination class.
     *
     * @var Pagination
     */
    public $pagination;

    /**
     * Holds the maximum number of records per page.
     *
     * @var int
     */
    public $limit = 6;

    /**
     * Holds the current order index.
     *
     * @var int
     */
    public $order = 0;

    /**
     * Holds the current sort dir(ection) index.
     *
     * @var int
     */
    public $dir = 0;

    /**
     * Container for order dir(ections).
     *
     * @var array
     */
    public $dir_map = array(
        0 => 'ASC',
        1 => 'DESC'
    );

    /**
     * Holds the name of the layout to use.
     *
     * @var string
     */
    public $layout;

    /**
     * Holds the total number of beans found.
     *
     * @var int
     */
    public $total_records = 0;

    /**
     * Checks if the URL for the profile is NULL, redirects to the current user hash if logged in.
     * If not logged in redirects to the login page
     * If specified the hash shows the desired user profile page
     *
     * @param string $hash
     */

    public function index($page, $hash = null)
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

        $this->records = R::findAll('report', "user_id=?", [$this->record->id]);

        /*
            [Flight::get('user')->getId()]
        */

        $this->pagination = new Pagination(
            Url::build("/profile"),
            $this->page,
            $this->limit,
            $this->layout,
            $this->order,
            $this->dir,
            $this->total_records
        );

        //Pass the records to the view

        $this->render();
    }

    public function getSql($fields = 'id', $where = '1', $order = null, $offset = null, $limit = null)
    {
        $sql = <<<SQL
    SELECT
        id
    FROM
      report

    WHERE
      user_id = Flight::get('user')->getId()
    SQL
        //add optional order by
        if ($order) {
                $sql .= " ORDER BY {$order}";
            }
            //add optional limit
        if ($offset || $limit) {
                $sql .= " LIMIT {$offset}, {$limit}";
            }
        return $sql;

    }

    /**
     * Edits the profile page
     *
     * @param string $hash
     */
    public function edit($hash)
    {
        $this->template = 'profile/edit';

        session_start();
        Auth::check();
        $hash = Flight::get('user')->hash;

        if (Flight::request()->method == 'POST') {
            Flight::get('user')->import(Flight::request()->data->dialog);
            try {
                R::store(Flight::get('user'));
                Flight::get('user')->notify(I18n::__('account_edit_success'), 'success');
                $this->redirect('/profile/');
            } catch (Exception $e) {
                Flight::get('user')->notify(I18n::__('account_edit_failure'), 'error');
            }
        }

        $this->record = Flight::get('user');
        $this->render();
    }

    /**
     * Renders the profile page.
     */

    public function render()
    {
        Flight::render('domaato/shared/notification', ['record' => $this->record], 'notification');
        //
        Flight::render('domaato/shared/navigation/account', [], 'navigation_account');
        Flight::render('domaato/shared/navigation/main', [], 'navigation_main');
        Flight::render('domaato/shared/navigation', [], 'navigation');
        Flight::render('domaato/shared/navigation2', [], 'navigation2');
        Flight::render('domaato/shared/header', [], 'header');
        Flight::render('domaato/shared/footer', [], 'footer');
        Flight::render($this->template, [
            'language' => Flight::get('language'),
            'record' => $this->record,
            'records' => $this->records
            ], 'content');
        Flight::render('domaato-html5', [
            'page_id' => 'file-a-report',
            'title' => I18n::__('domaato_report_'),
            'language' => Flight::get('language')
        ]);
    }
}
