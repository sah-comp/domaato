<?php
/**
 * Domaato header.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<header id="header-top" class="fixable">
	<h1>
		<a
		    class="ir logo"
			href="<?php echo Url::build('/file-a-report') ?>"
			title="<?php echo I18n::__('app_name_domaato') ?> <?php echo I18n::__('app_claim_domaato') ?>">
			<?php echo I18n::__('app_name_domaato') ?>
		</a>
	</h1>
	<h2 class="visuallyhidden"><?php echo I18n::__('app_claim_domaato') ?></h2>
	<?php if (isset($navigation)) {
    echo $navigation;
} ?>
</header>
<?php echo $navigation2; ?>