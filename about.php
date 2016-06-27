<?php
	include("config.php");
	require_once( CLASS_PATH . '/TemplateRenderer.php' );
	$obj = new Route();
	$renderer = new TemplateRenderer();

	echo $renderer->render('about.tpl', array(
	    'title' => 'Про нас',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => 'Some information about us',
  	));	
?>