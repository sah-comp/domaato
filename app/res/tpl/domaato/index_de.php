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

	<body id="splash">
		<!--[if lt IE 7]>
		<?php echo Flight::textile(I18n::__('browser_is_ancient')) ?>
		<![endif]-->
		<header>
		    <h1>Domaato</h1>
		</header>
		<?php if ( $notification ): ?>
        <div class="alert alert-<?php echo $notification['class'] ?>">
            <?php echo $notification['note'] ?>
        </div>
		<?php endif ?>
		<article>
            <form
                id="domaato-splash-dialog"
                class="panel panel-<?php echo $record->getMeta('type') ?>"
                method="POST"
                accept-charset="utf-8"
                enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
                    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
                </div>
                <div class="row">
		            <input 
		                type="email" 
		                name="dialog[email]" 
		                value="<?php echo $record->email ?>" 
		                placeholder="<?php echo I18n::__('domaato_placeholder_email_address') ?>"
		                required="required"
		                autofocus="autofocus" >
		            <p class="input-info"><?php echo I18n::__('domaato_info_email_address') ?></p>
		        </div>
		    </form>
		</article>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/js/domaato.js"></script>
	</body>
</html>
