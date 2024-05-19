<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {
		die;
	}

	if(isset($_POST)){
		$id = $_POST['id'];
		$camion = $_POST['camion'];
		$remolque = $_POST['remolque'];

		$sql->query("UPDATE `vehiculos_configuracion` SET `id_vehiculo` = '".$camion."', `id_remolque` = '".$remolque."' WHERE `id` = '".$id."'");
		
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>