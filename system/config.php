<?php 
	$sql = new mysqli(
		'localhost',
		'root',
		'',
		'dygsa'
	);

	if($sql->connect_error) {
    	exit("Fallo al conectar a MySQL: " . $sql->connect_error);
	} 

	$s = $sql->query("SELECT * FROM `site_config`");
	if ($s->num_rows)
	{
		$site = $s->fetch_assoc();

		Define('FileVehiculo_site', $site['url'].'/assets/files/vehiculos');
		Define('FileRemolques_site', $site['url'].'/assets/files/remolques');
		Define('FileEmpleados_site', $site['url'].'/assets/files/empleados');
		Define('FileFacturas_site', $site['url'].'/assets/files/facturas');
	}
?>