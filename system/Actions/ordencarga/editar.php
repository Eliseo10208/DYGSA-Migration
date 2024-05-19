<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {
		die;
	}

	$id = $_POST['id'];
	$nro_manifiesto = $_POST['nro_manifiesto'];
	$cliente = $_POST['cliente'];
	$tn = $_POST['tn'];
	$m3 = $_POST['m3'];
	$bc = $_POST['bc'];
	$servicio = $_POST['servicio'];
	$conductor = $_POST['conductor'];
	$segundo_conductor = $_POST['segundo_conductor'];
	$camion = $_POST['camion'];
	$ruta = $_POST['ruta'];
	$ida_costo_eje = $_POST['ida_costo_eje'];
	$vuelta_costo_eje = $_POST['vuelta_costo_eje'];
	$fecha_programacion = $_POST['fecha_programacion'];
	$fecha_presentacion = $_POST['fecha_presentacion'];
	$hora_presentacion = $_POST['hora_presentacion'];
	$lugar_carga = $_POST['lugar_carga'];
	$combustible = $_POST['combustible'];
	$carga = $_POST['carga'];
	$observacion = $_POST['observacion'];

	$c = $sql->query("UPDATE `ordencarga` SET `nro_manifiesto` = '".$nro_manifiesto."', 
													`cliente` = '".$cliente."', 
													`tn` = '".$tn."', 
													`m3` = '".$m3."', 
													`bc` = '".$bc."', 
													`servicio` = '".$servicio."', 
													`conductor` = '".$conductor."', 
													`conductor2` = '".$segundo_conductor."', 
													`vehiculo` = '".$camion."', 
													`ruta` = '".$ruta."', 
													`ida_costo_eje` = '".$ida_costo_eje."', 
													`vuelta_costo_eje` = '".$vuelta_costo_eje."', 
													`fecha_programacion` = '".$fecha_programacion."', 
													`fecha_presentacion` = '".$fecha_presentacion."', 
													`hora_presentacion` = '".$hora_presentacion."', 
													`lugar_carga` = '".$lugar_carga."', 
													`combustible` = '".$combustible."', 
													`carga` = '".$carga."', 
													`observacion` = '".$observacion."' WHERE `id` = '".$id."'");

	if($c)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>