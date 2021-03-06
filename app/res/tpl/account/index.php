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
<!-- Account -->
<article class="main">
    <header>
		<h1><?php echo I18n::__('account_h1') ?></h1>
		<nav>
            <?php echo $toolbar ?>
        </nav>
    </header>
    <form
        id="form-<?php echo $record->getMeta('type') ?>"
        class="panel panel-<?php echo $record->getMeta('type') ?> action-profile"
        method="POST"
        accept-charset="utf-8"
        enctype="multipart/form-data">
        <div>
            <img
        		src="<?php echo Gravatar::src($record->email, 72) ?>"
        		class="gravatar-account circular no-shadow"
        		width="72"
        		height="72"
        		alt="<?php echo htmlspecialchars($record->getName()) ?>" />
        </div>
        <!-- account form -->
        <fieldset>
            <legend><?php echo I18n::__('account_legend') ?></legend>
            <div
                class="row <?php echo $record->hasError('name') ? 'error' : '' ?>">
                <label
                    for="user-name">
                    <?php echo I18n::__('user_label_name') ?>
                </label>
                <input
                    type="text"
                    id="user-name"
                    name="dialog[name]"
                    value="<?php echo htmlspecialchars($record->name) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('email') ? 'error' : '' ?>">
                <label
                    for="user-email">
                    <?php echo I18n::__('user_label_email') ?>
                </label>
                <input
                    type="email"
                    id="user-email"
                    name="dialog[email]"
                    value="<?php echo htmlspecialchars($record->email) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('shortname') ? 'error' : '' ?>">
                <label
                    for="user-shortname">
                    <?php echo I18n::__('user_label_shortname') ?>
                </label>
                <input
                    type="text"
                    id="user-shortname"
                    name="dialog[shortname]"
                    value="<?php echo htmlspecialchars($record->shortname) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('screenname') ? 'error' : '' ?>">
                <label
                    for="user-screenname">
                    <?php echo I18n::__('user_label_screenname') ?>
                </label>
                <select
                    id="user-screenname"
                    name="dialog[screenname]">
                    <?php foreach (array('name','email','shortname') as $_attr_name): ?>
                    <option
                        value="<?php echo $_attr_name ?>"
                        <?php echo ($record->screenname == $_attr_name) ? 'selected="selected"' : '' ?>>
                        <?php echo I18n::__('user_label_'.$_attr_name) ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div
                class="row <?php echo $record->hasError('systemofunits') ? 'error' : '' ?>">
                <label
                    for="user-systemofunits">
                    <?php echo I18n::__('user_label_systemofunits') ?>
                </label>
                <select
                    id="user-systemofunits"
                    name="dialog[systemofunits]">
                    <?php foreach (array('metric','imperial','us') as $_attr_name): ?>
                    <option
                        value="<?php echo $_attr_name ?>"
                        <?php echo ($record->systemofunits == $_attr_name) ? 'selected="selected"' : '' ?>>
                        <?php echo I18n::__('user_label_unit_'.$_attr_name) ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div
                class="row <?php echo $record->hasError('apikey') ? 'error' : '' ?>">
                <label
                    for="user-apikey">
                    <?php echo I18n::__('user_label_apikey') ?>
                </label>
                <input
                    type="text"
                    id="user-apikey"
                    name="dialog[apikey]"
                    value="<?php echo htmlspecialchars($record->apikey) ?>"
                    readonly="readonly" />
                <p class="info"><?php echo I18n::__('user_info_apikey') ?></p>
            </div>
            <div class="row <?php echo ($record->hasError('testimonial')) ? 'error' : ''; ?>">
                <label
                    for="user-testimonial">
                    <?php echo I18n::__('user_label_testimonial') ?>
                </label>
                <textarea
                    id="user-testimonial"
                    name="dialog[testimonial]"
                    rows="5"
                    cols="60"><?php echo htmlspecialchars($record->testimonial) ?></textarea>
                <p class="info"><?php echo I18n::__('user_info_testimonial') ?></p>
            </div>
            <div class="row <?php echo ($record->hasError('public')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[public]"
                    value="0" />
                <input
                    id="user-public"
                    type="checkbox"
                    name="dialog[public]"
                    <?php echo ($record->public) ? 'checked="checked"' : '' ?>
                    value="1" />
                <label
                    for="user-public"
                    class="cb">
                    <?php echo I18n::__('user_label_public') ?>
                </label>
            </div>
        </fieldset>
        <!-- End of account form -->
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('account_submit') ?>" />
        </div>
    </form>
</article>
<!-- End of Account -->
