<button class="back_btn" onclick="pagemenu('camiones', {q: 'mantenimiento', d: '<?php echo $camion['id'];?>'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar un mantenimiento a <?php echo $camion['placa_rodaje'];?>
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_mantenimiento" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<input name="vehiculo" type="hidden" value="<?php echo $camion['id'];?>">
				<div class="group">
					<div class="label">Código</div>
					<input name="codigo" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">KM. Último recorrido</div>
					<input name="km_ultimo" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha Mantenimiento</div>
					<input name="fecha_mant" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Detalles</div>
					<textarea name="detalles" class="form-control" rows="5"></textarea>
				</div>
				<div class="group">
					<div class="label">KM. Proximo mantenimiento</div>
					<input name="km_prox_mant" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Observaciones</div>
					<textarea name="observaciones" class="form-control" rows="5"></textarea>
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		$('.crear_mantenimiento').ajaxForm({
	    	url: site.url+'/system/Actions/camion/crear_mantenimiento.php',
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);

	           	if(value.status == "success")
	           	{
	           		pagemenu('camiones', {q: 'mantenimiento', d: '<?php echo $camion['id'];?>'});
	           	}
	        }
	    });
	</script>
</div>