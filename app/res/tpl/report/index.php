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
        class="panel location"
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
                class="row <?php echo $record->hasError('searchtext') ? 'error' : '' ?>">
                <label
                    for="location-name">
                    <?php echo I18n::__('location_label_searchtext') ?>
                </label>
                <input
                    type="text"
                    id="location-searchtext"
                    name="dialog[searchtext]"
                    class="autocomplete"
                    data-source="<?php echo Url::build('/autocomplete/person/name/?callback=?') ?>"
                    data-spread='<?php echo json_encode(array('location-searchtext' => 'value')) ?>'
                    value="<?php echo htmlspecialchars($record->searchtext) ?>"
                    required="required"
    				autofocus="autofocus" />
            </div>
            <div
                class="row <?php echo $record->hasError('place') ? 'error' : '' ?>">
                <label
                    for="location-place">
                    <?php echo I18n::__('location_label_place') ?>
                </label>
                <input
                    type="text"
                    id="location-place"
                    name="dialog[place]"
                    value="<?php echo htmlspecialchars($record->place) ?>" />
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('location_submit') ?>" />
        </div>
    </form>
    <section id="places">
        <?php foreach ($records as $_id => $_place): ?>
        <div
            id="place-<?php echo $_place->getId() ?>"
            class="place">
            <h2>
                <a href="<?php echo Url::build( '/file-a-report/' . $_place->getId() ) ?>"><?php echo htmlspecialchars( $_place->name ) ?></a>
            </h2>
        </div>
        <?php endforeach ?>
    </section>
</article>

