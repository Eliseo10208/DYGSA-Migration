<button class="back_btn" onclick="pagemenu('clientes', {q: 'contacto', d: '<?php echo $contacto['id']?>'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar un nuevo contacto
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_cliente" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<input type="hidden" name="id" value="<?php echo $contacto['id']?>">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Documento</div>
					<input name="doc" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Nombre</div>
					<input name="nombre" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Cargo</div>
					<input name="cargo" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Celular</div>
					<input name="celular" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Celular 2</div>
					<input name="celular2" type="text" class="form-control">
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		$('.crear_cliente').ajaxForm({
	    	url: site.url+'/system/Actions/cliente/contacto/crear.php',
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);

	           	if(value.status == "success")
	           	{
	           		pagemenu('clientes', {q: 'contacto', d: '<?php echo $contacto['id']?>'})
	           	}
	        }
	    });
	</script>
</div>