<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {
		die;
	}

	if($_POST)
	{
		$id = $_POST['id'];
		$nombre_transportista = $_POST['nombre_transportista'];
		$nro_partida_registral = $_POST['nro_partida_registral'];
		$placa_rodaje = $_POST['placa_rodaje'];
		$clase_vehiculo = $_POST['clase_vehiculo'];
		$nro_ejes = $_POST['nro_ejes'];
		$año_fabricacion = $_POST['año_fabricacion'];
		$serie_chasis = $_POST['serie_chasis'];
		$modelo = $_POST['modelo'];
		$nro_asientos = $_POST['nro_asientos'];
		$configuracion = $_POST['configuracion'];
		$carroceria = $_POST['carroceria'];
		$capacidad_m3 = $_POST['capacidad_m3'];
		$capacidad_tn = $_POST['capacidad_tn'];
		$seguro = $_POST['seguro_compañia'];
		$fecha_pago_seguro = $_POST['fecha_pago_seguro'];
		$fecha_seguro = $_POST['fecha_seguro'];
		$fecha_cond_diso_emi = $_POST['fecha_cond_diso_emi'];
		$fecha_cond_diso_ven = $_POST['fecha_cond_diso_ven'];
		$fecha_humo_diso_emi = $_POST['fecha_humo_diso_emi'];
		$fecha_humo_diso_ven = $_POST['fecha_humo_diso_ven'];

		$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE id = '".$id."'");
		if($camion->num_rows)
		{
			$camion = $camion->fetch_assoc();

			$files = array('pdf_poliza_seguro' => array('name' => 'poliza_seguro', 'status' => ($camion['pdf_poliza_seguro'] == 1 ? true : false)), 
					'pdf_seguro_pago' => array('name' => 'pago_poliza_seguro', 'status' => ($camion['pdf_seguro_pago'] == 1 ? true : false)), 
					'pdf_cert_fisomeca' => array('name' => 'certificado_condiciones_fisomecanicas', 'status' => ($camion['pdf_cert_fisomeca'] == 1 ? true : false)), 
					'pdf_cert_humofisomeca' => array('name' => 'certificado_humos_fisomecanicas', 'status' => ($camion['pdf_cert_humofisomeca'] == 1 ? true : false)), 
					'pdf_tarjeta_propiedad' => array('name' => 'tarjeta_de_circulacion', 'status' => ($camion['pdf_tarjeta_propiedad'] == 1 ? true : false)));


			$folder = $camion['folder'];
			$path = FileVehiculo.'/'.$folder.'/';
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

			$sql->query("UPDATE `vehiculos_registro` SET `nombre_transportista` = '".$nombre_transportista."', 
															`nro_partida_registral` = '".$nro_partida_registral."', 
															`placa_rodaje` = '".$placa_rodaje."', 
															`clase_vehiculo` = '".$clase_vehiculo."', 
															`año_fabricacion` = '".$año_fabricacion."',
															`nro_ejes` = '".$nro_ejes."', 
															`serie_chasis` = '".$serie_chasis."', 
															`modelo` = '".$modelo."', 
															`nro_asientos` = '".$nro_asientos."', 
															`configuracion` = '".$configuracion."', 
															`carroceria` = '".$carroceria."', 
															`capacidad_m3` = '".$capacidad_m3."', 
															`capacidad_tn` = '".$capacidad_tn."', 
															`seguro` = '".$seguro."', 
															`fecha_pago_seguro` = '".$fecha_pago_seguro."', 
															`fecha_seguro` = '".$fecha_seguro."', 
															`fecha_cond_diso_emi` = '".$fecha_cond_diso_emi."', 
															`fecha_cond_diso_ven` = '".$fecha_cond_diso_ven."', 
															`fecha_humo_diso_emi` = '".$fecha_humo_diso_emi."',
															`fecha_humo_diso_ven` = '".$fecha_humo_diso_ven."',
															`pdf_poliza_seguro` = '".$files["pdf_poliza_seguro"]["status"]."',
															`pdf_seguro_pago` = '".$files["pdf_seguro_pago"]["status"]."',
															`pdf_cert_fisomeca` = '".$files["pdf_cert_fisomeca"]["status"]."',
															`pdf_cert_humofisomeca` = '".$files["pdf_cert_humofisomeca"]["status"]."',
															`pdf_tarjeta_propiedad` = '".$files["pdf_tarjeta_propiedad"]["status"]."' WHERE `id` = '".$id."'");


			echo json_encode(array('status' => 'success'));
		}
		else
		{
			echo json_encode(array('status' => 'error'));
			die;
		}
	}
	else
	{
		echo json_encode(array('status' => 'error'));
		die;
	}
?>