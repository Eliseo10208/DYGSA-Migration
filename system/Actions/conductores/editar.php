<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(!$perm->validate('permiso_maestro', 'permiso_admin', 'permiso_operadores')) {
		die;
	}
	
	$id = $_POST['id'];
	$tipo_licencia = $_POST['tipo_licencia'];
	$nro_licencia = $_POST['nro_licencia'];
	$nombre = $_POST['nombre'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$direccion = $_POST['direccion'];
	$celular = $_POST['celular'];
	$categoria = $_POST['categoria'];
	$fecha_venc_licencia = $_POST['fecha_venc_licencia'];
	$fecha_venc_rcontrol = $_POST['fecha_venc_rcontrol'];
	$fecha_venc_exmedico = $_POST['fecha_venc_exmedico'];

	$cargo = "conductor";

	$conductor = $sql->query("SELECT * FROM `empleados` WHERE id = '".$id."'");
	if(!$conductor->num_rows)
	{
		echo json_encode(array('status' => 'error'));
		die;
	}
	$conductor = $conductor->fetch_assoc();
	$folder = $conductor['folder'];

	$files = array('file_licencia' => array('name' => 'licencia', 'status' => ($conductor['file_licencia'] == 1 ? true : false)), 
					'file_r_control' => array('name' => 'r_control', 'status' => ($conductor['file_r_control'] == 1 ? true : false)), 
					'file_examen_medico' => array('name' => 'examen_medico', 'status' => ($conductor['file_examen_medico'] == 1 ? true : false)));

	
	$path = FileEmpleados.'/'.$folder.'/';
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

	$ca = $sql->query("UPDATE `empleados` SET `tipo_licencia` = '".$tipo_licencia."', `nro_licencia` = '".$nro_licencia."', `nombre` = '".$nombre."',`fecha_nacimiento` = '".$fecha_nacimiento."', `direccion` = '".$direccion."', `celular` = '".$celular."', `categoria` = '".$categoria."', `fecha_venc_licencia` = '".$fecha_venc_licencia."', `fecha_venc_rcontrol` = '".$fecha_venc_rcontrol."', `fecha_venc_exmedico` = '".$fecha_venc_exmedico."', `file_licencia` = '".$files["file_licencia"]["status"]."', `file_r_control` = '".$files["file_r_control"]["status"]."', `file_examen_medico` = '".$files["file_examen_medico"]["status"]."' WHERE `id` = '".$id."'");

	if($ca == true)
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
?>