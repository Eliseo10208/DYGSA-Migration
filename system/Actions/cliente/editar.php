<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_clients')) {
		die;
	}

	if(!isset($_POST)) die;

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$distrito = $_POST['distrito'];
	$provincia = $_POST['provincia'];
	$telefono = $_POST['telefono'];

	$c = $sql->query("UPDATE `clientes` SET `nombre` = '".$nombre."', 
													`ruc` = '".$ruc."', 
													`direccion` = '".$direccion."', 
													`distrito` = '".$distrito."', 
													`provincia` = '".$provincia."', 
													`telefono` = '".$telefono."' WHERE `id` = '".$id."'");

	if($c)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>