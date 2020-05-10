<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- report edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('report_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('person_id')) ? 'error' : ''; ?>">
        <label
            for="report-template">
            <?php echo I18n::__('report_label_person') ?>
        </label>
        <select
            id="report-person"
            name="dialog[person_id]"
            required="required">
            <option value=""><?php echo I18n::__('report_person_please_select') ?></option>
            <?php foreach (R::find('person', ' enabled = 1 ORDER BY name') as $_id => $_person): ?>
            <option
                value="<?php echo $_person->getId() ?>"
                <?php echo ($record->person_id == $_person->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_person->name) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('vote')) ? 'error' : ''; ?>">
        <label
            for="report-vote">
            <?php echo I18n::__('report_label_vote') ?>
        </label>
        <select
            id="report-vote"
            name="dialog[vote]"
            required="required">
            <option value=""><?php echo I18n::__('report_label_select') ?></option>
            <?php foreach (array(0, 1) as $_vote): ?>
            <option
                value="<?php echo $_vote ?>"
                <?php echo ($record->vote == $_vote) ? 'selected="selected"' : '' ?>>
                <?php echo I18n::__('report_vote_'.$_vote) ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('content')) ? 'error' : ''; ?>">
        <label
            for="report-content">
            <?php echo I18n::__('report_label_content') ?>
        </label>
        <textarea
            id="report-content"
            name="dialog[content]"
            rows="8"
            cols="60"
            required="required"><?php echo htmlspecialchars($record->content) ?></textarea>
    </div>
    <div class="row <?php echo ($record->hasError('memo')) ? 'error' : ''; ?>">
        <label
            for="report-memo">
            <?php echo I18n::__('report_label_memo') ?>
        </label>
        <textarea
            id="report-memo"
            name="dialog[memo]"
            rows="4"
            cols="60"
            required="required"><?php echo htmlspecialchars($record->memo) ?></textarea>
		<p class="info"><?php echo I18n::__('report_info_memo') ?></p>
    </div>

    <div class="row <?php echo ($record->hasError('testdb')) ? 'error' : ''; ?>">
        <label
            for="report-testdb">
            <?php echo I18n::__('report_label_testdb') ?>
        </label>
        <textarea
            id="report-testdb"
            name="dialog[testdb]"
            rows="4"
            cols="60"
            required="required"><?php echo htmlspecialchars($record->testdb) ?></textarea>
		<p class="info"><?php echo I18n::__('report_info_testdb') ?></p>
    </div>

</fieldset>
<!-- end of report edit form -->
