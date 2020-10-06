<?php
/**
 * Domaato.
 *
 * @package Domaato
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
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="/css/jquery.fullpage.min.css">
		<link rel="stylesheet" href="/css/animations.css">
		<?php if (isset($stylesheets) && is_array($stylesheets)): ?>
            <?php foreach ($stylesheets as $_n=>$_stylesheet): ?>
            <link rel="stylesheet" href="/css/<?php echo $_stylesheet; ?>.css">
            <?php endforeach; ?>
		<?php endif ?>
		<link rel="stylesheet" href="/css/domaato-website.css">
		<!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <![endif]-->
	</head>

	<body>

    <!-- Content (required) -->
		<?php echo $content; ?>
		<!-- End of required content -->

    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/jquery-ui-1.11.1.min.js"></script>
    <script src="/js/jquery.form.min.js"></script>
    <script src="/js/scrolloverflow.min.js"></script>
    <script src="/js/jquery.fullpage.min.js"></script>
    <script src="/js/countUp.min.js"></script>
    <script src="/js/css3-animate-it.js"></script>
    <?php if (isset($javascripts) && is_array($javascripts)): ?>
      <?php foreach ($javascripts as $_n=>$_js): ?>
      <script src="<?php echo $_js; ?>.js"></script>
      <?php endforeach; ?>
		<?php endif ?>
		<script src="/js/domaato-website.js"></script>
	</body>
</html>
