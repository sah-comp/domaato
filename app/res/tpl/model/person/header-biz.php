<?php
/**
 * Cinnebar.
 *
 * This template shows a person bean with its name as headline, an gravatar icon, a list of
 * all tags the bean was tagged with and the default postal address, the phone number and
 * the website address if any of these exist.
 *
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */

/**
 * Get the defaul post address of the person bean.
 */
$address = $record->getAddress();

/**
 * Get all labels (tags) of the person bean.
 */
$bizkinds = $record->sharedBizkind;
?>
<header class="biz">

    <h1><?php echo $record->getName() ?></h1>

    <?php if ($record->email): ?>
    <img src="<?php echo Gravatar::src($record->email, 120) ?>" alt="" title="" width="120" height="120" />
    <?php endif; ?>

    <?php if ($bizkinds): ?>
    <ul class="tags">
        <?php foreach ($bizkinds as $_id => $_bizkind): ?>
        <li><?php echo $_bizkind->i18n($language)->name ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if ($address->getId()): ?>
    <p class="address">
        <?php echo nl2br($record->getAddress()->getFormattedAddress()) ?>
    </p>
    <?php endif; ?>

    <?php if ($record->url): ?>
    <p class="website">
        <a href="<?php echo $record->url ?>" class="external" rel="nofollow"><?php echo $record->url ?></a>
    </p>
    <?php endif; ?>

    <?php if ($record->phone): ?>
    <p class="phone">
        <?php echo $record->phone ?>
    </p>
    <?php endif; ?>

</header>
