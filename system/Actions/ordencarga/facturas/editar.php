<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;

	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {
		die;
	}

	$orden = $_POST['orden'];
	$factura = $_POST['factura'];
	$nro_factura = $_POST['nro_factura'];
	$monto = $_POST['monto'];
	$monto_iva = $_POST['monto_iva'];
	$monto_retención = $_POST['monto_retención'];
	$total = $_POST['total'];

	$camion = $sql->query("SELECT * FROM `ordencarga_facturas` WHERE id = '".$factura."'");
	if($camion->num_rows)
	{
		$camion = $camion->fetch_assoc();

		$files = array('file_factura' => array('name' => 'factura', 'status' => ($camion['file_factura'] == 1 ? true : false), 'type' => $camion['file_type']));

		$folder = $camion['folder'] ;
		$path = FileFacturas.'/'.$folder.'/';
		if (!file_exists($path)) {
		    mkdir($path, 0777, true);
		}

		foreach ($files as $key => $value) {
			if(isset($_FILES[$key]))
			{
				if($camion['file_factura'] == 1 && file_exists($path.'/factura.'.$camion['file_type']))
				{
					unlink($path.'/factura.'.$camion['file_type']);
				}

				$ext = explode("/", $_FILES[$key]['type'])[1];
				$file_content = file_get_contents($_FILES[$key]['tmp_name']);
		 		$file_dump = file_put_contents($path.$value["name"].'.'.$ext, $file_content);

		 		$files[$key]["type"] = $ext;
		 		$files[$key]["status"] = true;
			}
		}

		$c = $sql->query("UPDATE `ordencarga_facturas` SET `nro_factura` = '".$nro_factura."', 
														`monto` = '".$monto."', 
														`monto_iva` = '".$monto_iva."', 
														`monto_retención` = '".$monto_retención."', 
														`total` = '".$total."', 
														`file_factura` = '".$files["file_factura"]["status"]."',
														`file_type` = '".$files["file_factura"]["type"]."' WHERE `id` = '".$factura."'
														");

		if($c)
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