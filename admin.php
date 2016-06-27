<?php
	session_start();

	include("config.php");
	$obj = new Route();
	$renderer = new TemplateRenderer();
	$submenu = array('Головна' => 'admin.php');

	$action = isset($_GET['action']) ? $_GET['action'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
	if ( $action != "login" && $action != "logout" && !$username ) {
		login();
	  	exit;
	}
	
	switch($action) {
		case 'login':
			login();
			break;
		case 'logout':
			logout();
			break;
		case 'routes':
			routes($type);
			break;
		case 'route':
			route($_GET['id']);
			break;
		case 'addRoute':
			add_route($type, $name);
			break;
		case 'delRoute':
			delete_route($type, $id);
			break;			
		default:
			adminHome();
	}

	function login() {
		global $obj, $renderer;
		if (isset($_POST["login"])) {
			$user = $_POST["username"];
			$pass = $_POST["password"];
			
			if($obj->isLogin($user, $pass)) {
				$_SESSION["username"] = $user;
				header("Location: admin.php");
			} else {
				echo $renderer->render('admin_login.tpl', array(
			    'title' => 'Авторизація',
			    'noLogin' => 'Неправильний користувач або пароль!',
		  	));
			}

		} else {
			
			echo $renderer->render('admin_login.tpl', array(
			    'title' => 'Авторизація',
		  	));
		}		
	}

	function  logout() {
	  unset( $_SESSION['username'] );
	  header( "Location: admin.php" );
	}	

	function adminHome() {
		global $obj, $renderer;
		$data = $obj->getRoutes();
		echo $renderer->render('admin_home.tpl', array(
			'title' => 'Сторінка адміністратора',
		    'user' => $_SESSION["username"],
		    'menu' => $obj->getMenu(1),
		    'routes' => $data["routes"],

	  	));
	}

	function routes($type = '') {
		global $obj, $renderer;
		$data = $obj->getRoutes();
		$typeOfRoutes = $obj->getTypeOfRoutes($type);

		if(!strlen($type)) {
			echo $renderer->render('admin_routes.tpl', array(
			    'submenu' => $submenu,
			    'title' => 'Маршрути',
			    'user' => $_SESSION["username"],
			    'menu' => $obj->getMenu(1),
			    'typeOfRoute' =>$typeOfRoutes,
		  	));
		} else {
			echo $renderer->render('admin_route.tpl', array(
			    'submenu' => $submenu,
			    'title' => 'Маршрути >> ',
			    'user' => $_SESSION["username"],
			    'menu' => $obj->getMenu(1),
			    'typeOfRoute' =>$typeOfRoutes[$type],
			    'routes' => $data["routes"][$type],
			    'type' => $type,
		  	));
		}
	}



	function add_route($type, $name = '') {
		global $obj, $renderer, $data;
		$typeOfRoutes = $obj->getTypeOfRoutes($type);
		$result = 0;

		if(strlen($name)) {
			$result = 1;
			$obj->addNewRoute($name, $type);
		}

		echo $renderer->render('admin_add_route.tpl', array(
		    'submenu' => $submenu,
		    'title' => 'Новий маршрут',
		    'user' => $_SESSION["username"],
		    'menu' => $obj->getMenu(1),
		    'typeOfRoute' =>$typeOfRoutes[$type],
		    'type' => $type,
		    'result' => $result,
	  	));				

	}	
	
	function delete_route($type, $id = '') {
		global $obj, $renderer, $data;

		if(strlen($id)) $obj->deleteRoutes($id);

		$result = 0;
		$data = $obj->getRoutes();
	
		echo $renderer->render('admin_delete_route.tpl', array(
		    'submenu' => $submenu,
		    'title' => 'Видалити маршрут',
		    'user' => $_SESSION["username"],
		    'menu' => $obj->getMenu(1),
		    //'typeOfRoute' =>$typeOfRoutes[$type],
		    'type' => $type,
		    'result' => $result,
		    'routes' => $data["routes"][$type],
	  	));				

	}		
	

	function route($id) {
		global $obj, $renderer, $data;
		$data = $obj->getRouteEdit($id);
		echo $renderer->render('admin_edit_route.tpl', array(
			    'submenu' => $submenu,
			    'title' => 'Маршрут >> ' . $id ,
			    'user' => $_SESSION["username"],
			    'menu' => $obj->getMenu(1),
			    'nameOfRoute' => $data['nameOfRoute'],
			    'straightRoute' => $data['straightRoute'],
			    'ustraightRoute' => $data['unstraightRoute'],
			    'stops' => $data['stops'],
		  	));

	}



?>		