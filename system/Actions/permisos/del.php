<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!$perm->validate("permiso_maestro")) {
		die;
	}

	$name = $_POST['name'];
	
	$select = $sql->query("SELECT * FROM `admin_roles` WHERE `name` = '".$name."'");
	if($select->num_rows)
	{
		$users = $sql->query("SELECT * FROM `admin_users` WHERE `rol` = '".$name."'");
		if($users->num_rows)
		{
			while($row = $users->fetch_array())
			{
				$sql->query("UPDATE `admin_users` SET `rol` = 'user' WHERE `id` = '".$row['id']."'");
			}
		}

		$in = $sql->query("DELETE FROM `admin_roles` WHERE `name` = '".$name."'");

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
		echo json_encode(array('status' => 'error'));
	}
	
?>