<?php
/**
 * Domaato account navigation.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- account menu -->
<ul class="account-navigation">
<?php if (! Flight::has('user')): ?>
        <li><a href="<?php echo Url::build('/login') ?>" rel="nofollow"><?php echo I18n::__('domaato_account_login') ?></a></li>
        <li><a href="<?php echo Url::build('/register') ?>" rel="nofollow"><?php echo I18n::__('domaato_account_register') ?></a></li>
    <?php else: ?>

    <li>
        <a
            href="<?php echo Url::build('/profile/') ?>">
			<img
				src="<?php echo Gravatar::src(Flight::get('user')->email, 24) ?>"
                class="circular circular-24 no-shadow"
                width="24"
                height="24"
				alt="<?php echo htmlspecialchars(Flight::get('user')->getName()) ?>" />
			<?php echo htmlspecialchars(Flight::get('user')->getName()) ?>
        </a>
    </li>
    <li>
        <a
            href="<?php echo Url::build('/logout/') ?>">
            <?php echo I18n::__('domaato_account_logout') ?>
        </a>
    </li>
    <?php endif; ?>
</ul>
<!-- End of account menu -->
