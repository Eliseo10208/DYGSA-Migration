<?php
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_rutas');
	
	$ruta = $sql->query("SELECT * FROM `rutas` WHERE id = '".$page3."'");
	if(!$ruta->num_rows)
	{
		echo "<script>pagemenu('rutas')</script>";
		die;
	}

	$ruta = $ruta->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('rutas')">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar una ruta
			<p>Administración de transporte de carga</p>
		</div>
	</div>

	<form class="form_s edit_ruta" data-ajax="false" method="post" enctype="multipart/form-data">
		<input name="id" type="hidden" value="<?php echo $ruta['id'];?>">
		<div class="row">
			<div class="col-md-6">
				<div class="group">
					<div class="label">Origen</div>
					<input name="origen" type="text" class="form-control" value="<?php echo $ruta['origen'];?>">
				</div>
				<div class="group">
					<div class="label">Destino</div>
					<input name="destino" type="text" class="form-control" value="<?php echo $ruta['destino'];?>">
				</div>
				<div class="group">
					<div class="label">Kms</div>
					<input name="kms" type="text" class="form-control" value="<?php echo $ruta['kms'];?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="group">
					<div class="label">Combustible</div>
					<input name="combustible" type="number" step="0.01" placeholder="0.00" class="form-control" value="<?php echo $ruta['combustible'];?>">
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.edit_ruta').ajaxForm({
	    	url: site.url+'/system/Actions/ruta/editar.php',     
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);
	           	if(value.status == "success")
	           	{
	           		pagemenu('rutas');
	           	}
	        }
	    });
	</script>
</div>