<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {
		die;
	}

	if(isset($_POST)){
		$id = $_POST['id'];

		$sql->query("DELETE FROM `vehiculos_configuracion` WHERE `id` = '".$id."'");
		
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>