<?php
	if(!isset($_POST)) die;

	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$origen = $_POST['origen'];
	$destino = $_POST['destino'];
	$combustible = $_POST['combustible'];
	$kms = $_POST['kms'];

	$sql->query("INSERT INTO `rutas` SET `origen` = '".$origen."', `destino` = '".$destino."', `kms` = '".$kms."', `combustible` = '".$combustible."'");

	$id = $sql->insert_id;
	if($id > 0)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>