<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	header('Content-type: application/pdf');

	require(Modules.'fpdf.php');
	$id = $_GET['id'];
	$orden = $sql->query("SELECT * FROM `ordencarga` WHERE `id` = '".$id."'");
	if(!$orden->num_rows)
	{
		die;
	}
	$orden = $orden->fetch_assoc();

	$rutas = $sql->query("SELECT * FROM `rutas` WHERE `id` = '".$orden['ruta']."'");
	$rutas = $rutas->fetch_assoc();
	$conductor = $sql->query("SELECT nombre FROM `empleados` WHERE `id` = '".$orden['conductor']."'");
	$conductor = $conductor->fetch_assoc();

	$conductor2 = $sql->query("SELECT nombre FROM `empleados` WHERE `id` = '".$orden['conductor2']."'");
	$conductor2 = $conductor2->fetch_assoc();
	$con = "";
	$config = $sql->query("SELECT * FROM `vehiculos_configuracion` WHERE `id` = '".$orden['vehiculo']."'");
	if($config->num_rows) {
		$config = $config->fetch_assoc();

		$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE `id` = '".$config['id_vehiculo']."'");
		$camion = $camion->fetch_assoc();
		$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE `id` = '".$config ['id_remolque']."'");
		$remolque = $remolque->fetch_assoc();
		
		$con = $camion['placa_rodaje'].$remolque['placa'];
	}

	$pdf = new FPDF();

	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$table = $pdf->GetPageWidth() / 2 - 10;
	$pdf->setMargins(10, 10, 10);
  	$pdf->SetDrawColor(255, 255, 255);

  	$pdf->SetTextColor(30, 62, 101);
  	$pdf->Cell(110,30, $pdf->Image($site['url'].'/assets/img/logo.png', $pdf->GetX(), $pdf->GetY() + 10,50),1, 0);
  	
  	$pdf->SetDrawColor(0, 0, 0);
  	$pdf->SetFillColor(76,146,199);
  	$pdf->Cell(80, 10, 'Orden de carga Nro '.$orden['nro_manifiesto'], 1, 1,"", true);
   	$pdf->SetFillColor(208,230,247);
   	$pdf->Cell(110,30, '',0, 0);
   	$pdf->Cell(80, 30, ($rutas['origen'] !== null ? $rutas['origen'].' - '.$rutas['destino'] : ''), 1, 1,"", true);

   	$pdf->Cell(70, 10, '', 0, 1);

   	$pdf->SetDrawColor(255, 255, 255);
  	$pdf->SetFillColor(76,146,199);
   	$pdf->Cell($table, 5, '', 1, 0,"", true);
   	$pdf->Cell($table, 5, '', 1, 1,"", true);

   	$pdf->SetFillColor(208,230,247);

   	$pdf->Cell($table, 10, 'Conductor 01', 1, 0,"", true);
   	$pdf->Cell($table, 10, ($conductor['nombre'] !== null ? $conductor['nombre'] : ''), 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Conductor 02', 1, 0,"", true);
   	$pdf->Cell($table, 10, ($conductor2['nombre'] !== null ? $conductor2['nombre'] : ''), 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Tn', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['tn'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'M3', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['m3'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'B/C', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['bc'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Tipo de servicio', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['servicio'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Configuración', 1, 0,"", true);
   	$pdf->Cell($table, 10, $con, 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Ruta', 1, 0,"", true);
   	$pdf->Cell($table, 10, ($rutas['origen'] !== null ? $rutas['origen'].' - '.$rutas['destino'] : ''), 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Costo Ida', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['ida_costo_eje'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Costo Vuelta', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['vuelta_costo_eje'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Fecha de programacion', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['fecha_programacion'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Fecha de presentacion', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['fecha_presentacion'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Combustible', 1, 0,"", true);
   	$pdf->Cell($table, 10, $orden['combustible'], 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Carga', 1, 0,"", true);
   	$pdf->Cell($table, 10, (strlen($orden['carga']) > 0 ? $orden['carga'] : 'Ninguno'), 1, 1,"", true);
   	$pdf->Cell($table, 10, 'Observacion', 1, 0,"", true);
   	$pdf->Cell($table, 10, (strlen($orden['observacion']) > 0 ? $orden['observacion'] : 'Ninguno'), 1, 1,"", true);

	echo $pdf->Output("",'S');
?>