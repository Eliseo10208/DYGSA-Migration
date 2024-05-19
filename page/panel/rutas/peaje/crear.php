<button class="back_btn" onclick="pagemenu('rutas', {q: 'peaje', d: '<?php echo $peaje['id'];?>'})">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar nuevo peaje
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_peaje" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<input name="ruta" type="hidden" value="<?php echo $peaje['id'];?>">
				<div class="group">
					<div class="label">Nombre</div>
					<input name="nombre" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Ubicación</div>
					<input name="ubicacion" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Costo</div>
					<input name="costo" type="number" step="0.01" placeholder="0.00" class="form-control">
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.crear_peaje').ajaxForm({
	    	url: site.url+'/system/Actions/ruta/peaje/crear.php',
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);
	           	if(value.status == "success")
	           	{
	           		pagemenu('rutas', {q: 'peaje', d: '<?php echo $peaje['id'];?>'})
	           	}
	        }
	    });
	</script>
</div>