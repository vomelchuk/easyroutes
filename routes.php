<?php

	include("config.php");
	$obj = new Route();
	$renderer = new TemplateRenderer();

$route = isset( $_GET['route'] ) ? $_GET['route'] : "";
$id = isset( $_GET['id'] ) ? $_GET['id'] : "";

switch ( $route ) {
	case 'single':
		showRouteByStations($id);
		break;
	case 'streets':
		showRouteByStreets($id);
		break;
	case 'coord':
		getCoord($id);
		break;		
	default:
		listRoutes();
}

function listRoutes() {
	global $obj, $renderer;
	$data = $obj->getRoutes();
	echo $renderer->render('routes.tpl', array(
	    'title' => 'Маршрути',
	    'asideContent' => $data['asidebar'],
	    'sectionContent' => $data['routes'],
  	));	
}

function showRouteByStations($id) {
	global $obj, $renderer;
	$data = $obj->getRoutes();
	echo $renderer->render('routeByStations.tpl', array(
	    'title' => 'Маршрут',
	    'asideContent' => $data['routes'],
	    'sectionContent' => $obj->getRouteByStations($id),
	    'id' => $id,	    
  	));
}





function showRouteByStreets($id) {
	global $obj, $renderer;
	$data = $obj->getRoutes();
	echo $renderer->render('routeByStreets.tpl', array(
	    'title' => 'Маршрут',
	    'asideContent' => $data['routes'],
	    'sectionContent' => $obj->getRouteByStreets($id),
	    'id' => $id,	    
  	));
}

function getCoord($id) {
	global $obj;
	echo json_encode($obj->getStationsCoord($id));
}


?>
