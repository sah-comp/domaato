<?php
/**
 * Cinnebar.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<article>
    <form
        id="form-location"
        class="location"
        method="POST"
        accept-charset="utf-8">
        <div>
            <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
            <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
            <input
                type="hidden"
                name="dialog[stamp]"
                value="<?php echo htmlspecialchars($record->stamp) ?>" />
        </div>
        <fieldset>
            <legend><?php echo I18n::__('location_legend') ?></legend>
            <div
                class="row searchtext <?php echo $record->hasError('searchtext') ? 'error' : '' ?>">
                <label
                    for="location-name">
                    <?php echo I18n::__('domaato_location_label_searchtext') ?>
                </label>
                <input
                    type="text"
                    id="location-searchtext"
                    name="dialog[searchtext]"
                    class="autocomplete"
                    autocomplete="off"
                    data-source="<?php echo Url::build('/autocomplete/person/name/?callback=?') ?>"
                    data-spread='<?php echo json_encode(array('location-searchtext' => 'value')) ?>'
                    placeholder="<?php echo I18n::__('domaato_location_placeholder_searchtext') ?>"
                    value="<?php echo htmlspecialchars($record->searchtext) ?>"
    				autofocus="autofocus" />
            </div>
            <div
                class="row place <?php echo $record->hasError('place') ? 'error' : '' ?>">
                <label
                    for="location-place">
                    <?php echo I18n::__('domaato_location_label_place') ?>
                </label>
                <input
                    type="text"
                    id="location-place"
                    name="dialog[place]"
                    autocomplete="off"
                    placeholder="<?php echo I18n::__('domaato_location_placeholder_place') ?>"
                    value="<?php echo htmlspecialchars($record->place) ?>" />
            </div>
            <div class="buttons">
                <input type="submit" class="find-btn ir" name="submit" value="<?php echo I18n::__('domaato_location_submit') ?>" />
            </div>
        </fieldset>
    </form>
    <section id="places" class="clearfix">
        <?php
        /**
         * Go through all found places (person beans) and check if there is
         * already a report. If there is one, count the positives and negatives.
         */
        foreach ($records as $_id => $_place):
            $_has_reports = $_place->countOwn('report');
            $_address = $_place->getAddress();
        ?>
        <div
            id="place-<?php echo $_place->getId() ?>"
            class="place">
            <h2>
                <a href="<?php echo Url::build('/file-a-report/' . $_place->getId()) ?>"><?php echo htmlspecialchars($_place->name) ?></a>
            </h2>
            <?php if ($_has_reports): ?>
            <p class="positive"><?php echo $_place->positive ?></p>
            <p class="negative"><?php echo $_place->negative ?></p>
            <?php else: ?>
            <p class="befirst clearfix"><?php echo I18n::__('domaato_location_file_the_first_report') ?></p>
            <?php endif; ?>
            <p class="city clearfix">
            <?php echo $_address->city ?><?php if ($_address->county): ?><?php echo ', ', $_address->county ?><?php endif; ?>
            </p>
        </div>
        <?php endforeach ?>
    </section>
</article>
