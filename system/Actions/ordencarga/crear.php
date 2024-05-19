<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		die(json_encode(array('status' => 'error', 'message' => 'Invalid request method')));
	}

	// Check if all required POST variables are set
	$required_fields = [
		'nro_manifiesto', 'cliente', 'tn', 'm3', 'bc', 'servicio',
		'conductor', 'segundo_conductor', 'camion', 'ruta', 'ida_costo_eje',
		'vuelta_costo_eje', 'fecha_programacion', 'fecha_presentacion', 
		'hora_presentacion', 'lugar_carga', 'combustible', 'carga', 'observacion'
	];

	foreach ($required_fields as $field) {
		if (!isset($_POST[$field])) {
			die(json_encode(array('status' => 'error', 'message' => 'Missing field: ' . $field)));
		}
	}

	// Escape POST variables to prevent SQL injection
	$nro_manifiesto = $sql->real_escape_string($_POST['nro_manifiesto']);
	$cliente = $sql->real_escape_string($_POST['cliente']);
	$tn = $sql->real_escape_string($_POST['tn']);
	$m3 = $sql->real_escape_string($_POST['m3']);
	$bc = $sql->real_escape_string($_POST['bc']);
	$servicio = $sql->real_escape_string($_POST['servicio']);
	$conductor = $sql->real_escape_string($_POST['conductor']);
	$segundo_conductor = $sql->real_escape_string($_POST['segundo_conductor']);
	$camion = $sql->real_escape_string($_POST['camion']);
	$ruta = $sql->real_escape_string($_POST['ruta']);
	$ida_costo_eje = $sql->real_escape_string($_POST['ida_costo_eje']);
	$vuelta_costo_eje = $sql->real_escape_string($_POST['vuelta_costo_eje']);
	$fecha_programacion = $sql->real_escape_string($_POST['fecha_programacion']);
	$fecha_presentacion = $sql->real_escape_string($_POST['fecha_presentacion']);
	$hora_presentacion = $sql->real_escape_string($_POST['hora_presentacion']);
	$lugar_carga = $sql->real_escape_string($_POST['lugar_carga']);
	$combustible = $sql->real_escape_string($_POST['combustible']);
	$carga = $sql->real_escape_string($_POST['carga']);
	$observacion = $sql->real_escape_string($_POST['observacion']);

	// Use prepared statement
	$query = "INSERT INTO `ordencarga` 
		(`nro_manifiesto`, `cliente`, `tn`, `m3`, `bc`, `servicio`, 
		`conductor`, `conductor2`, `vehiculo`, `ruta`, `ida_costo_eje`, 
		`vuelta_costo_eje`, `fecha_programacion`, `fecha_presentacion`, 
		`hora_presentacion`, `lugar_carga`, `combustible`, `carga`, `observacion`) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$stmt = $sql->prepare($query);
	if (!$stmt) {
		die(json_encode(array('status' => 'error', 'message' => 'Prepare failed: ' . $sql->error)));
	}

	$stmt->bind_param('sssssssssssssssssss', $nro_manifiesto, $cliente, $tn, $m3, $bc, $servicio,
		$conductor, $segundo_conductor, $camion, $ruta, $ida_costo_eje, $vuelta_costo_eje,
		$fecha_programacion, $fecha_presentacion, $hora_presentacion, $lugar_carga,
		$combustible, $carga, $observacion);

	if ($stmt->execute()) {
		$id = $sql->insert_id;
		echo json_encode(array('status' => 'success', 'id' => $id));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Execute failed: ' . $stmt->error));
	}

	$stmt->close();
	$sql->close();
?>
