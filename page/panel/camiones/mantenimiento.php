<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE id = '".$page3."'");
	if(!$camion->num_rows)
	{
		echo "<script>pagemenu('camiones');</script>";
		die;
	}

	$camion = $camion->fetch_assoc();

	if(!isset($page4))
	{
		require(Page.'/panel/camiones/mantenimiento/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/camiones/mantenimiento/'.$page4.'.php'))
		{
			require(Page.'/panel/camiones/mantenimiento/'.$page4.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>
