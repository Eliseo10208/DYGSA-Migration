<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$orden = $sql->query("SELECT * FROM `ordencarga` WHERE `id` = '".$page3."'");
	if(!$orden->num_rows)
	{
		echo "<script>pagemenu('ordencarga');</script>";
		die;
	}
	$orden = $orden->fetch_assoc();

	if(!isset($page4))
	{
		require(Page.'/panel/ordencarga/facturas/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/ordencarga/facturas/'.$page4.'.php'))
		{
			require(Page.'/panel/ordencarga/facturas/'.$page4.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>
