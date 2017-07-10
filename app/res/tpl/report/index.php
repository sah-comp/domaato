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

	<body id="writeareport">
		<!--[if lt IE 7]>
		<?php echo Flight::textile(I18n::__('browser_is_ancient')) ?>
		<![endif]-->
		<header>
		    <h1>Domaato</h1>
		</header>
		<article>
            <h1>Write a report</h1>
		</article>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/js/domaato.js"></script>
	</body>
</html>
