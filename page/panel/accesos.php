<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$perm->get("permiso_maestro", "permiso_admin");

	if(is_null($page2))
	{
		require(Page.'panel/accesos/home.php');
	}
	else
	{
		if(file_exists(Page.'panel/accesos/'.$page2.'.php'))
		{
			require(Page.'panel/accesos/'.$page2.'.php');
		}
		else
		{
			echo "<script>pagemenu('404');</script>";
		}
	}
?>