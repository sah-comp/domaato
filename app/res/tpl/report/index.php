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
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html lang="<?php echo $language ?>" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="<?php echo $language ?>" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
		<link rel="stylesheet" href="/css/domaato.css">
		<!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <![endif]-->
	</head>

	<body id="find-a-location">
		<!--[if lt IE 7]>
		<?php echo Flight::textile(I18n::__('browser_is_ancient')) ?>
		<![endif]-->
		<header>
		    <h1>Domaato</h1>
		</header>
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
                        class="row <?php echo $record->hasError('name') ? 'error' : '' ?>">
                        <label
                            for="location-name">
                            <?php echo I18n::__('location_label_name') ?>
                        </label>
                        <input
                            type="text"
                            id="location-name"
                            name="dialog[name]"
                            value="<?php echo htmlspecialchars($record->name) ?>"
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
                <?php foreach ($places as $_id => $_place): ?>
                <div
                    id="place-<?php echo $_place->getId() ?>"
                    class="place">
                    <h2>
                        <a href="<?php echo Url::build( '/fileareport/' . $_place->getId() ) ?>"><?php echo htmlspecialchars( $_place->name ) ?></a>
                    </h2>
                </div>
                <?php endforeach ?>
            </section>
		</article>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/js/domaato.js"></script>
	</body>
</html>
