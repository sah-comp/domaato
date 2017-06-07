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
        $record = R::dispense('email');
        $notification = array();
        if ( Flight::request()->query->thanks ) {
            $notification = array(
                'note' => I18n::__('domaato_notification_got_your_email'),
                'class' => 'success'
            );
        }
        if (Flight::request()->method == 'POST') {
            $record = R::graph( Flight::request()->data->dialog, TRUE );
            R::begin();
            try {
                R::store($record);
                R::commit();
                $this->redirect('/?thanks=1');
            }
            catch (Exception $e) {
                error_log($e);
                $notification = array(
                    'note' => I18n::__('domaato_notification_failed_to_store_your_email'),
                    'class' => 'error'
                );
                R::rollback();
            }
        }
        Flight::render('domaato/index_' . Flight::get('language'), array(
            'title' => I18n::__('domaato_index_title'),
            'language' => Flight::get('language'),
            'record' => $record,
            'notification' => $notification
        ));
    }
}
