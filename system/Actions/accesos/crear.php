<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro", "permiso_admin")) {
		die;
	}

	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$permiso = $_POST['permiso'];
	$apellido = $_POST['apellido'];

	$in = $sql->query("INSERT INTO `admin_users` SET `name` = '".$nombre."', `lastname` = '".$apellido."', `email` = '".$email."', `rol` = '".$permiso."', `registerdate` = '".time()."'");

	if($in)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}

?>