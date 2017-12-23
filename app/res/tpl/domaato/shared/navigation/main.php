<?php
/**
 * Domaato main navigation.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- main navigation -->
<?php echo R::load('domain', 15)
                    ->hierMenu('/', Flight::get('language'))
                    ->render(array('class' => 'main-navigation clearfix'));
?>
<!-- End of admin navigation -->
