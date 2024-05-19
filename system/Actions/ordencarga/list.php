<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	$list = array();
	$orden = $sql->query("SELECT * FROM `ordencarga`");

	if($orden->num_rows)
	{
		while($row = $orden->fetch_array())
		{
			$con = array(
				'id' => $row['id'],
				'nro_manifiesto' => $row['nro_manifiesto'],
				'tn' => $row['tn'],
				'm3' => $row['m3'],
				'bc' => $row['bc'],
				'servicio' => $row['servicio'],
				'ida_costo_eje' => $row['ida_costo_eje'],
				'vuelta_costo_eje' => $row['vuelta_costo_eje'],
				'fecha_programacion' => $row['fecha_programacion'],
				'fecha_presentacion' => $row['fecha_presentacion'],
				'hora_presentacion' => $row['hora_presentacion'],
				'lugar_carga' => $row['lugar_carga'],
				'combustible' => $row['combustible'],
				'carga' => $row['carga'],
				'observacion' => $row['observacion'],
				'factura' => false
			);
			$facturas = $sql->query("SELECT count(*) as total FROM `ordencarga_facturas` WHERE `orden` = '".$row['id']."'");
			$facturas = $facturas->fetch_assoc();
			$con['factura'] = $facturas['total'];

			$cliente = $sql->query("SELECT nombre FROM `clientes` WHERE `id` = '".$row['cliente']."'");
			$cliente = $cliente->fetch_assoc();
			$con['cliente'] = ($cliente && $cliente['nombre'] !== null ? $cliente['nombre'] : '');

			$conductor = $sql->query("SELECT nombre FROM `empleados` WHERE `id` = '".$row['conductor']."'");
			$conductor = $conductor->fetch_assoc();
			$con['conductor'] = ($conductor && $conductor['nombre'] !== null ? $conductor['nombre'] : '');

			$conductor2 = $sql->query("SELECT nombre FROM `empleados` WHERE `id` = '".$row['conductor2']."'");
			$conductor2 = $conductor2->fetch_assoc();
			$con['conductor2'] = ($conductor2 && $conductor2['nombre'] !== null ? $conductor2['nombre'] : '');

			$config = $sql->query("SELECT * FROM `vehiculos_configuracion` WHERE `id` = '".$row['vehiculo']."'");
			if($config->num_rows) {
				$config = $config->fetch_assoc();

				$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE `id` = '".$config['id_vehiculo']."'");
				$camion = $camion->fetch_assoc();
				$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE `id` = '".$config['id_remolque']."'");
				$remolque = $remolque->fetch_assoc();
				
				$con['vehiculo'] = ($camion && $remolque ? $camion['placa_rodaje'].$remolque['placa'] : '');
			}
			else
			{
				$con['vehiculo'] = "";
			}

			$rutas = $sql->query("SELECT * FROM `rutas` WHERE `id` = '".$row['ruta']."'");
			$rutas = $rutas->fetch_assoc();
			$con['ruta'] = ($rutas && $rutas['origen'] !== null ? $rutas['origen'].' - '.$rutas['destino'] : '');

			array_push($list, $con);
		}
	}

	echo json_encode(array('list' => $list));
?>
