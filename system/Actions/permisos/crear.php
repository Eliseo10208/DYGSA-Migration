<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro")) {
		die;
	}

	$name = $_POST['name'];
	$permiso_ordenes = ($_POST['permiso_ordenes'] == 'on' ? 1 : 0);
	$permiso_unidades = ($_POST['permiso_unidades'] == 'on' ? 1 : 0);
	$permiso_operadores = ($_POST['permiso_operadores'] == 'on' ? 1 : 0);
	$permiso_rutas = ($_POST['permiso_rutas'] == 'on' ? 1 : 0);
	$permiso_clients = ($_POST['permiso_clients'] == 'on' ? 1 : 0);
	$permiso_admin = ($_POST['permiso_admin'] == 'on' ? 1 : 0);

	$select = $sql->query("SELECT * FROM `admin_roles` WHERE `name` = '".$name."'");
	if(!$select->num_rows)
	{
		$in = $sql->query("INSERT INTO `admin_roles` SET `name` = '".$name."', `permiso_ordenes` = '".$permiso_ordenes."', `permiso_unidades` = '".$permiso_unidades."', `permiso_operadores` = '".$permiso_operadores."', `permiso_rutas` = '".$permiso_rutas."', `permiso_clients` = '".$permiso_clients."', `permiso_admin` = '".$permiso_admin."'");

		if($in)
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
		echo json_encode(array('status' => 'found_item'));
	}
	
?>