<?php
	require($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$code = $_POST['code'];
	$pass = $_POST['pass'];
	$repass = $_POST['repass'];

	$check = $sql->query("SELECT * FROM `recovery` WHERE `code` = '".$code."'");
	if($check->num_rows)
	{
		$check = $check->fetch_assoc();

		if($pass == $repass)
		{
			$in = $sql->query("UPDATE `admin_users` SET `password` = '".$pass."' WHERE `id` = '".$check['id_admin']."'");
			if($in)
			{
				$sql->query("DELETE FROM `recovery` WHERE `code` = '".$code."'");

				echo json_encode(array('status' => 'success', 'msg' => 'Se ha cambiado la contraseña exitosamente.'));
			}
			else
			{
				echo json_encode(array('status' => 'error', 'msg' => 'No se pudo cambiar la contraseña'));
			}
		}
		else
		{
			echo json_encode(array('status' => 'error', 'msg' => 'Las contraseñas no coinciden.'));
		}
	}
	else
	{
		echo json_encode(array('status' => 'error', 'msg' => 'No se pudo cambiar la contraseña'));
	}
	
?>