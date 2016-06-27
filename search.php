<?php
	include("config.php");
	$obj = new Route();
	$renderer = new TemplateRenderer();

$station = isset( $_GET['station'] ) ? $_GET['station'] : "";
$station_1 = isset( $_GET['station_1'] ) ? $_GET['station_1'] : "";
$station_2 = isset( $_GET['station_2'] ) ? $_GET['station_2'] : "";
$str = isset( $_GET['str'] ) ? $_GET['str'] : "";
$sid1 = isset( $_GET['sid1'] ) ? $_GET['sid1'] : "";
$sid2 = isset( $_GET['sid2'] ) ? $_GET['sid2'] : "";



switch ( $station ) {
	case 'search':
		showStations($str);
		break;
	case 'result':
		showResult($sid1, $sid2);
		break;		
	default:
		searchForm();
}


function searchForm() {
	global $obj, $renderer;
	echo $renderer->render('search.tpl', array(
	    'title' => 'Пошук',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => $obj->getAlphabet(),
	    'isResult' => 0,
	    'station1' => $_GET['station_1'],
	    'station2' => $_GET['station_2'],
	    'sid1' => $_GET['sid1'],
	    'sid2' => $_GET['sid2'],
  	));	
}

function showStations($str) {
	global $obj;
	echo json_encode($obj->getStationBySearch($str));
}

function showResult($s1, $s2) {
	global $obj, $renderer;
	echo $renderer->render('search.tpl', array(
	    'title' => 'Пошук',
	    'asideContent' => $obj->getAsidebar(),
	    'sectionContent' => $obj->getResultSearch($s1, $s2),
	    'isResult' => 1,
	    'station1' => $_GET['station_1'],
	    'station2' => $_GET['station_2'],
	    'sid1' => $_GET['sid1'],
	    'sid2' => $_GET['sid2'],
  	));
}

?>
