<button class="back_btn" onclick="pagemenu('rutas')">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar una nueva ruta
			<p>Administración de transporte de carga</p>
		</div>
	</div>

	<form class="form_s crear_camion" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<div class="group">
					<div class="label">Origen</div>
					<input name="origen" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Destino</div>
					<input name="destino" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Kms</div>
					<input name="kms" type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="group">
					<div class="label">Combustible</div>
					<input name="combustible" type="number" step="0.01" placeholder="0.00" class="form-control">
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.crear_camion').ajaxForm({
	    	url: site.url+'/system/Actions/ruta/crear.php',     
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