<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');


	$contacto = $sql->query("SELECT * FROM `clientes` WHERE `id` = '".$page3."'");
	if(!$contacto->num_rows)
	{
		echo "<script>pagemenu('clientes');</script>";
		die;
	}
	$contacto = $contacto->fetch_assoc();

	if(!isset($page4))
	{
		require(Page.'/panel/clientes/contacto/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/clientes/contacto/'.$page4.'.php'))
		{
			require(Page.'/panel/clientes/contacto/'.$page4.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>
