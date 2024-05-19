<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(is_null($page2))
	{
		require(Page.'panel/conductores/home.php');
	}
	else
	{
		if(file_exists(Page.'panel/conductores/'.$page2.'.php'))
		{
			require(Page.'panel/conductores/'.$page2.'.php');
		}
		else
		{
			echo "<script>pagemenu('404');</script>";
		}
	}
?>