<?php
/**
 * Cinnebar.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */

/**
 * Load the comments for this report.
 */
$comments = $record->with(" ORDER BY stamp ")->ownComment;
?>
<article>
    <?php
    Flight::render('model/person/header-biz', array(
        'record' => $record->person
    ));
    ?>
    <section class="report">
        <header>
            <p><?php echo $record->stamp ?></p>
            <p><?php echo $record->user->getName() ?></p>
        </header>
        <?php echo Flight::textile($record->content) ?>
    </section>
    <section class="container-comment">
        <?php foreach ($comments as $_id => $_comment): ?>
        <article id="comment-<?php echo $_comment->getId() ?>">
            <header>
                <p><?php echo $_comment->stamp ?></p>
                <p><?php echo $_comment->user->getName() ?></p>
            </header>
            <?php echo Flight::textile($_comment->content) ?>
        </article>
        <?php endforeach; ?>
    </section>
    <form
        id="form-comment"
        class="panel report"
        method="POST"
        action="<?php echo Url::build('/review-a-report/%d/comment/add', array($record->getId())) ?>"
        accept-charset="utf-8">
        <fieldset>
            <legend><?php echo I18n::__('comment_legend_content') ?></legend>
            <div
                class="row <?php echo $record->hasError('content') ? 'error' : '' ?>">
                <label
                    for="comment-content">
                    <?php echo I18n::__('comment_label_content') ?>
                </label>
                <textarea
                    id="comment-content"
                    name="dialog[content]"
                    required="required"><?php echo htmlspecialchars($record->content) ?></textarea>
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('comment_submit') ?>" />
        </div>
    </form>
</article>
