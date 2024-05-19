<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;

	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$distrito = $_POST['distrito'];
	$provincia = $_POST['provincia'];
	$telefono = $_POST['telefono'];

	$c = $sql->query("INSERT INTO `clientes` SET `nombre` = '".$nombre."', 
													`direccion` = '".$direccion."', 
													`distrito` = '".$distrito."', 
													`provincia` = '".$provincia."', 
													`telefono` = '".$telefono."'");

	if($c)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}



