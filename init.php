<?php
	session_start();

	error_reporting(E_ALL ^ E_NOTICE);

	date_default_timezone_set('America/Caracas');

	define('BASE_PATH', dirname(__FILE__));
	define('System', BASE_PATH.'/system/');
	define('PageSystem', BASE_PATH.'/page/system/');
	define('Page', BASE_PATH.'/page/');
	define('Modules', System.'modules/');
	define('FileVehiculo', BASE_PATH.'/assets/files/vehiculos/');
	define('FileRemolques', BASE_PATH.'/assets/files/remolques/');
	define('FileEmpleados', BASE_PATH.'/assets/files/empleados/');
	define('FileFacturas', BASE_PATH.'/assets/files/facturas/');

	require(Modules.'Core.php');
	require(System.'config.php');

	setlocale(LC_MONETARY,"en_US");
	
	if(isset($_POST['s'])){
		$page = $_POST['s'];
	}else{
		$page = $_GET['s'] ?? null;
	}
	if(is_null($page)){
		$page = "home";
	}
	if(isset($_POST['q'])){
		$page2 = $_POST['q'];
	}else{
		$page2 = $_GET['q'] ?? null;
	}
	if(isset($_POST['d'])){
		$page3 = $_POST['d'];
	}else{
		$page3 = $_GET['d'] ?? null;
	}
	if(isset($_POST['u'])){
		$page4 = $_POST['u'];
	}else{
		$page4 = $_GET['u'] ?? null;
	}
	if(isset($_POST['c'])){
		$page5 = $_POST['c'];
	}else{
		$page5 = $_GET['c'] ?? null;
	}
	if(isset($_POST['r'])){
		$page6 = $_POST['r'];
	}else{
		$page6 = $_GET['r'] ?? null;
	}
	if(isset($_POST['f'])){
		$page7 = $_POST['f'];
	}else{
		$page7 = $_GET['f'] ?? null;
	}
	if(isset($_POST['g'])){
		$page8 = $_POST['g'];
	}else{
		$page8 = $_GET['g'] ?? null;
	}
	if(isset($_POST['h'])){
		$page9 = $_POST['h'];
	}else{
		$page9 = $_GET['h'] ?? null;
	}

	if(!isset($_SESSION['client']))
	{
		$client = null;
	}
	else
	{
		$client = $_SESSION['client'];
	}


	if(!is_null($client))
	{
		$client_panel = $sql->query("SELECT * FROM `admin_users` WHERE id = '".$client."'");
		if($client_panel->num_rows)
		{
			$client_panel = $client_panel->fetch_assoc();

			require(Modules.'permisos.php');
		}
		else
		{
			unset($_SESSION['client']);
			echo '<script>window.location.href = "'.$site['url'].'";</script>';
		}
	}
?>