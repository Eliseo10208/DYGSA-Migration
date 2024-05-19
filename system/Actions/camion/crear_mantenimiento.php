<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!isset($_POST)) die;

	$vehiculo = $_POST['vehiculo'];
	$codigo = $_POST['codigo'];
	$km_ultimo = $_POST['km_ultimo'];
	$fecha_mant = $_POST['fecha_mant'];
	$detalles = $_POST['detalles'];
	$km_prox_mant = $_POST['km_prox_mant'];
	$observaciones = $_POST['observaciones'];

	$sql->query("INSERT INTO `vehiculos_mantenimiento` SET `vehiculo` = '".$vehiculo."', `codigo` = '".$codigo."', `km_ultimo` = '".$km_ultimo."', `fecha_mant` = '".$fecha_mant."', `detalles` = '".$detalles."', `km_prox_mant` = '".$km_prox_mant."', `observaciones` = '".$observaciones."'");

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