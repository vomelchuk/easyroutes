<?php

	include("config.php");
	$obj = new Route();
	$renderer = new TemplateRenderer();

$station = isset( $_GET['station'] ) ? $_GET['station'] : "";
$lid = isset( $_GET['lid'] ) ? $_GET['lid'] : "";
$sid = isset( $_GET['sid'] ) ? $_GET['sid'] : "";

switch ( $station ) {
	case 'list':
		showStationByStreet($lid);
		break;
	case 'single':
		showStation($lid, $sid);
		break;		
	default:
		listAlphabet();
}


function listAlphabet() {
	global $obj, $renderer;
	echo $renderer->render('stations.tpl', array(
	    'title' => 'Зупинки за алфавітом',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => $obj->getAlphabet(),
  	));	
}

function showStationByStreet($lid) {
	global $obj, $renderer;
	echo $renderer->render('stationsByStreets.tpl', array(
	    'title' => 'Зупинки по вулицях',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => $obj->getStationsByStreet($lid),
	    'lid' => $lid,
  	));	
}

function showStation($lid, $sid) {
	global $obj, $renderer;
	echo $renderer->render('station.tpl', array(
	    'title' => 'Зупинка',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => $obj->getStation($sid),
	    'sid' => $sid,
	    'lid' => $lid,
  	));	
}

?>
