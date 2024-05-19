<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(isset($_POST)){
		$camion = $_POST['camion'];
		$remolque = $_POST['remolque'];

		$sql->query("INSERT INTO `vehiculos_configuracion` SET `id_vehiculo` = '".$camion."', `id_remolque` = '".$remolque."'");
		
		if($sql->insert_id !== 0)
		{
			echo json_encode(array('status' => 'success'));
		}
		else
		{
			echo json_encode(array('status' => 'error'));
		}
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>