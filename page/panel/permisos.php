<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$perm->get("permiso_maestro");

	if(is_null($page2))
	{
		require(Page.'panel/permisos/home.php');
	}
	else
	{
		if(file_exists(Page.'panel/permisos/'.$page2.'.php'))
		{
			require(Page.'panel/permisos/'.$page2.'.php');
		}
		else
		{
			echo "<script>pagemenu('404');</script>";
		}
	}
?>