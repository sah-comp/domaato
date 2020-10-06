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


<article class="profile_edit">

    <section>
        
<form
        id="form-<?php echo $record->getMeta('type') ?>"
        class="panel panel-<?php echo $record->getMeta('type') ?>"
        method="POST"
        accept-charset="utf-8"
        enctype="multipart/form-data">

        <fieldset>
            <div class="row">
                <label
                    for="report-person">
                    <?php echo I18n::__('user_name') ?>
                </label>
                <input        type="text"
                    id="user-name"
                    name="dialog[name]"
                    value="<?php echo htmlspecialchars($record->name) ?>"
                    required="required" />
            </div>
            <div class="row">
                <label
                    for="report-person">
                    <?php echo I18n::__('user_email') ?>
                </label>
                <input  type="email"
                    id="user-email"
                    name="dialog[email]"
                    value="<?php echo htmlspecialchars($record->email) ?>"
                    required="required" />
            </div>

            <div class="row">
                <label
                    for="report-person">
                    <?php echo I18n::__('user_testimonial') ?>
                </label>
                <textarea
                id="user-testimonial"
                    name="dialog[testimonial]"
                    rows="5"
                    cols="60"
                    >
                    <?php echo htmlspecialchars($record->testimonial) ?>
                    </textarea>
            </div>

            <div class="row">
                <label
                    for="report-person">
                    <?php echo I18n::__('user_about') ?>
                </label>
                <textarea
                id="user-about"
                    name="dialog[about]"
                    rows="5"
                    cols="60"
                    >
                    
                    </textarea>
            </div>
        </fieldset>
             <!-- End of account form -->
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('account_submit') ?>" />
        </div>

</form>    


    </section>
</article>