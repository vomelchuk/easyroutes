<?php
	include("config.php");
	require_once( CLASS_PATH . '/TemplateRenderer.php' );
	$obj = new Route();
	$renderer = new TemplateRenderer();

	echo $renderer->render('home.tpl', array(
	    'title' => 'Львівські маршрутки (навчальний проект)',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => 'Lorem ipsum dolor sit amet, et vivendum conceptam deterruisset vel. Odio autem nihil ad nam, natum nonumy pro at. Tibique patrioque referrentur per te. Homero accusam his in, vix ei malis movet. Vel ex augue voluptatum, quo odio pertinax at. Ius deleniti sapientem iudicabit te, at nam luptatum signiferumque. Odio constituam sed ad. Rebum inimicus appellantur no eum. Exerci iisque eu quo, duis illud mea et. His et atqui splendide, facer oblique nominati ex eum. Eu legimus adipiscing mea, mei at augue noluisse complectitur, eu mel idque graeci. Iuvaret assentior cum ne, habeo elitr ea pri. Noluisse honestatis dissentiunt mea ei. Has ea augue invenire, usu ne saperet aliquando. Has aliquip vocibus in. An nam honestatis sadipscing, aeterno denique in est. Accusam necessitatibus eam an. Ea has facer tamquam. Eum nemore repudiare cu. Ad sumo mentitum posidonium nam, his ad appetere invenire. Munere soleat has ea, nisl quodsi splendide eu duo, nam inimicus urbanitas an. Alterum suscipit an mel, veritus perfecto appellantur ex vis. Cu vel dicunt antiopam perpetua, ei vero docendi reprimique qui. Eos ea tollit liberavisse, nec ei utinam fastidii invenire. Eam verterem laboramus no. Ex quo legimus volumus conclusionemque, sea eros cetero atomorum eu.',
  	));	
?>