<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$peaje = $sql->query("SELECT * FROM `rutas` WHERE `id` = '".$page3."'");
	if(!$peaje->num_rows)
	{
		echo "<script>pagemenu('rutas');</script>";
		die;
	}
	$peaje = $peaje->fetch_assoc();

	if(!isset($page4))
	{
		require(Page.'/panel/rutas/peaje/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/rutas/peaje/'.$page4.'.php'))
		{
			require(Page.'/panel/rutas/peaje/'.$page4.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>
