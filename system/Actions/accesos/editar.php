<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro", "permiso_admin")) {
		die;
	}

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$permiso = $_POST['permiso'];
	$apellido = $_POST['apellido'];

	$in = $sql->query("UPDATE `admin_users` SET `name` = '".$nombre."', `lastname` = '".$apellido."', `rol` = '".$permiso."' WHERE `id` = '".$id."'");

	if($in)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}

?>