<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE id = '".$page4."'");
	if(!$remolque->num_rows)
	{
		echo "<script>pagemenu('camiones', {q: 'remolques'})</script>";
		die;
	}

	$remolque = $remolque->fetch_assoc();

	if(!isset($page5))
	{
		require(Page.'/panel/camiones/remolques/mantenimiento/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/camiones/remolques/mantenimiento/'.$page5.'.php'))
		{
			require(Page.'/panel/camiones/remolques/mantenimiento/'.$page5.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>