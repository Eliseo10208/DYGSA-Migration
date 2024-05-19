<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro", "permiso_admin")) {
		die;
	}

	$id = $_POST['id'];

	$del = $sql->query("DELETE FROM `admin_users` WHERE `id` = '".$id."'");
	if($del)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>