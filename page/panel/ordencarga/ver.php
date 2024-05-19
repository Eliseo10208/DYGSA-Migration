<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$orden = $sql->query("SELECT * FROM `ordencarga` WHERE id = '".$page3."'");
	if(!$orden->num_rows)
	{
		echo "<script>pagemenu('ordencarga');</script>";
		die;
	}

	$orden = $orden->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('ordencarga');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Orden de carga Nº <?php echo $orden['nro_manifiesto'];?>
			<p>Administración de transporte de carga</p>
		</div>
	</div>

	<iframe src="<?php echo $site['url'];?>/system/orden.php?id=<?php echo $orden['id']?>" style="margin-top: 30px;width: 100%;border: 0;height: 787px;"></iframe>
</div>