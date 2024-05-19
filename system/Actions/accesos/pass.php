<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro", "permiso_admin")) {
		die;
	}

	$id = $_POST['id'];
	$pass = $_POST['password'];
	$repass = $_POST['repassword'];

	if($pass == $repass)
	{
		$in = $sql->query("UPDATE `admin_users` SET `password` = '".$pass."' WHERE `id` = '".$id."'");

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
		echo json_encode(array('status' => 'error_no_coincide'));
	}
?>