<?php
	if(!isset($_POST)) die;

	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_rutas')) {
		die;
	}

	$id = $_POST['id'];
	$origen = $_POST['origen'];
	$destino = $_POST['destino'];
	$combustible = $_POST['combustible'];
	$kms = $_POST['kms'];

	$sql->query("UPDATE `rutas` SET `origen` = '".$origen."', `destino` = '".$destino."', `kms` = '".$kms."', `combustible` = '".$combustible."' WHERE `id` = '".$id."'");

	echo json_encode(array('status' => 'success'));
?>