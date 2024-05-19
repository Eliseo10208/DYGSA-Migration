<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!isset($_POST)) die;

	$nombre_transportista = $_POST['nombre_transportista'];
	$placa_rodaje = $_POST['placa_rodaje'];
	$marca = $_POST['marca'];
	$seguro = $_POST['seguro_compañia'];
	$fecha_pago_seguro = $_POST['fecha_pago_seguro'];
	$fecha_seguro = $_POST['fecha_seguro'];
	$fecha_cond_diso_emi = $_POST['fecha_cond_diso_emi'];
	$fecha_cond_diso_ven = $_POST['fecha_cond_diso_ven'];
	$fecha_humo_diso_emi = $_POST['fecha_humo_diso_emi'];
	$fecha_humo_diso_ven = $_POST['fecha_humo_diso_ven'];

	$files = array('pdf_poliza_seguro' => array('name' => 'poliza_seguro', 'status' => false), 
					'pdf_seguro_pago' => array('name' => 'pago_poliza_seguro', 'status' => false), 
					'pdf_cert_fisomeca' => array('name' => 'certificado_condiciones_fisomecanicas', 'status' => false), 
					'pdf_cert_humofisomeca' => array('name' => 'certificado_humos_fisomecanicas', 'status' => false),
					'pdf_informacion_remolque' => array('name' => 'informacion_remolque', 'status' => false));

	$folder = time();
	$path = FileRemolques.'/'.$folder.'/';
	if (!file_exists($path)) {
	    mkdir($path, 0777, true);
	}

	foreach ($files as $key => $value) {
		if(isset($_FILES[$key]))
		{
			$ext = explode("/", $_FILES[$key]['type'])[1];
			$file_content = file_get_contents($_FILES[$key]['tmp_name']);
	 		$file_dump = file_put_contents($path.$value["name"].'.'.$ext, $file_content);

	 		$files[$key]["status"] = true;
		}
	}

	$sql->query("INSERT INTO `vehiculos_remolques` SET `folder` = '".$folder."', `nombre` = '".$nombre_transportista."', `placa` = '".$placa_rodaje."', `marca` = '".$marca."', `seguro` = '".$seguro."', `fecha_pago_seguro` = '".$fecha_pago_seguro."', `fecha_seguro` = '".$fecha_seguro."', `fecha_cond_diso_emi` = '".$fecha_cond_diso_emi."', `fecha_cond_diso_ven` = '".$fecha_cond_diso_ven."', `fecha_humo_diso_emi` = '".$fecha_humo_diso_emi."', `fecha_humo_diso_ven` = '".$fecha_humo_diso_ven."', `pdf_poliza_seguro` = '".$files["pdf_poliza_seguro"]["status"]."', `pdf_seguro_pago` = '".$files["pdf_seguro_pago"]["status"]."', `pdf_cert_fisomeca` = '".$files["pdf_cert_fisomeca"]["status"]."', `pdf_cert_humofisomeca` = '".$files["pdf_cert_humofisomeca"]["status"]."',  `pdf_informacion_remolque` = '".$files["pdf_informacion_remolque"]["status"]."'");

	$id = $sql->insert_id;
	if($id > 0)
	{
		echo json_encode(array('status' => 'success', 'id' => $id));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}

?>