<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;

	$id = $_POST['id'];
	$doc = $_POST['doc'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$celular = $_POST['celular'];
	$celular2 = $_POST['celular2'];

	$c = $sql->query("INSERT INTO `clientes_contactos` SET `cliente` = '".$id."', 
													`doc` = '".$doc."', 
													`nombre` = '".$nombre."', 
													`cargo` = '".$cargo."', 
													`celular` = '".$celular."', 
													`celular2` = '".$celular2."'");

	if($c)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>