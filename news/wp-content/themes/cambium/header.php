<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Cambium
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php 
	include 'corecss.php';
	wp_head();
	
	?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site-wrapper site">

	<?php
	// Site Header
	get_template_part( 'template-parts/site-h' );
	//	include 'nav.php';
	?>

	<div id="content" class="site-content">
