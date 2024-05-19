<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;

	$orden = $_POST['orden'];
	$nro_factura = $_POST['nro_factura'];
	$monto = $_POST['monto'];
	$monto_iva = $_POST['monto_iva'];
	$monto_retención = $_POST['monto_retención'];
	$total = $_POST['total'];


	$files = array('file_factura' => array('name' => 'factura', 'status' => false, 'type' => ''));

	$folder = time();
	$path = FileFacturas.'/'.$folder.'/';
	if (!file_exists($path)) {
	    mkdir($path, 0777, true);
	}

	foreach ($files as $key => $value) {
		if(isset($_FILES[$key]))
		{
			$ext = explode("/", $_FILES[$key]['type'])[1];
			$file_content = file_get_contents($_FILES[$key]['tmp_name']);
	 		$file_dump = file_put_contents($path.$value["name"].'.'.$ext, $file_content);

	 		$files[$key]["type"] = $ext;
	 		$files[$key]["status"] = true;
		}
	}

	$c = $sql->query("INSERT INTO `ordencarga_facturas` SET `orden` = '".$orden."', `folder` = '".$folder."', `nro_factura` = '".$nro_factura."', 
													`monto` = '".$monto."', 
													`monto_iva` = '".$monto_iva."', 
													`monto_retención` = '".$monto_retención."', 
													`total` = '".$total."', 
													`file_factura` = '".$files["file_factura"]["status"]."',
													`file_type` = '".$files["file_factura"]["type"]."'
													");

	if($c)
	{
		$id = $sql->insert_id;
		echo json_encode(array('status' => 'success', 'id' => $id));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>