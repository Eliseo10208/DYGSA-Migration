<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$email = strtolower($email);
	
	$query = $sql->query("SELECT * FROM `admin_users` WHERE email = '".$email."'");
	if($query->num_rows)
	{
		$user = $query->fetch_assoc();

		if(is_null($user['password']))
		{
			$user['password'] = $pass;
			$sql->query("UPDATE `admin_users` SET `password` = '".$pass."' WHERE `id` = '".$user['id']."'");
		}

		if($user['password'] == $pass)
		{
			$_SESSION['client'] = $user['id'];

			echo json_encode(array('status' => 'success'));
		}
		else
		{
			echo json_encode(array('status' => 'error', 'msg' => 'Email y contraseña no coinciden.'));
		}
	}
	else
	{
		echo json_encode(array('status' => 'error', 'msg' => 'Email y contraseña no coinciden.'));
	}
?>