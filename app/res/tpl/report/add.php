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
    <?php
    Flight::render('model/person/header-biz', array(
        'record' => $record->person
    ));
    ?>
    <form
        id="form-report"
        class="panel report"
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
            <legend><?php echo I18n::__('report_vote_legend') ?></legend>
             <div
                class="row <?php echo $record->hasError('vote') ? 'error' : '' ?>">
                <label
                    class="radio"
                    for="report-vote-dislike">
                    <?php echo I18n::__('report_label_vote_dislike') ?>
                </label>
                <input
                    type="radio"
                    id="report-vote-dislike"
                    name="dialog[vote]"
                    value="0"
                    <?php echo ($record->vote == 0) ? 'checked="checked"' : '' ?>>
            </div>
            <div
                class="row <?php echo $record->hasError('vote') ? 'error' : '' ?>">
                <label
                    class="radio"
                    for="report-vote-like">
                    <?php echo I18n::__('report_label_vote_like') ?>
                </label>
                <input
                    type="radio"
                    id="report-vote-like"
                    name="dialog[vote]"
                    value="1"
                    <?php echo ($record->vote == 1) ? 'checked="checked"' : '' ?>>
            </div> 
 
            <legend><?php echo I18n::__('report_content_legend') ?></legend>
            <div
                class="row <?php echo $record->hasError('content') ? 'error' : '' ?>">
                <label
                    for="report-content">
                    <?php echo I18n::__('report_label_content') ?>
                </label>
                <textarea
                    id="report-content"
                    name="dialog[content]"
                    rows="13"
                    required="required"><?php echo htmlspecialchars($record->content) ?></textarea>
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('report_submit') ?>" />
        </div>
    </form>
</article>
