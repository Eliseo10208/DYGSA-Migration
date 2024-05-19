<?php
	if(!isset($_POST)) die;

	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$ruta = $_POST['ruta'];
	$nombre = $_POST['nombre'];
	$ubicacion = $_POST['ubicacion'];
	$costo = $_POST['costo'];

	$sql->query("INSERT INTO `rutas_peajes` SET `ruta` = '".$ruta."', `nombre` = '".$nombre."', `ubicacion` = '".$ubicacion."', `costo` = '".$costo."'");

	$id = $sql->insert_id;
	if($id > 0)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>