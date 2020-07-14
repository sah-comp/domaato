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

<form
        id="form-<?php echo $record->getMeta('type') ?>"
        class="panel panel-<?php echo $record->getMeta('type') ?>"
        method="POST"
        accept-charset="utf-8"
        enctype="multipart/form-data">

<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('report_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('user_id')) ? 'error' : ''; ?>">
        <!--<label
            for="report-user">
            <?php echo I18n::__('report_label_user') ?>
        </label>-->

        <input type="hidden" name="dialog[user_id]" value="<?php echo Flight::get('user')->getId() ?>" />        
       
       <!-- <select
            id="report-user"
            name="dialog[user_id]"
            required="required"
            >
            <option value="<?php echo Flight::get('user')->id ?>"><?php echo Flight::get('user')->name ?></option>
            <option value=""><?php echo I18n::__('report_user_please_select') ?></option>
            <?php foreach (R::findAll('user', "ORDER BY name") as $_id => $_user): ?>
            <option
                value="<?php echo $_user->getId() ?>"
                <?php echo ($record->user_id == $_user->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_user->getName()) ?></option>
            <?php endforeach ?> 
        </select>-->
    </div>
    <div class="row <?php echo ($record->hasError('person_id')) ? 'error' : ''; ?>">
        <label
            for="report-person">
            <?php echo I18n::__('report_label_person') ?>
        </label>
        <select
            id="report-person"
            name="dialog[person_id]"
            required="required">
            <option value=""><?php echo I18n::__('report_person_please_select') ?></option>
            <?php foreach (R::findAll('person', "ORDER BY name") as $_id => $_person): ?>
            <option
                value="<?php echo $_person->getId() ?>"
                <?php echo ($record->person_id == $_person->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_person->uniqueName()) ?></option>
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
    <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('report_submit') ?>" />
    </div>
</fieldset>

<!-- end of report edit form -->
</form>
</article>
