<button class="back_btn" onclick="pagemenu('permisos');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Crear permiso
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_permiso" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Nombre</div>
					<input type="text" class="form-control" name="name" required>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar <br>registros de viaje</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_ordenes" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar unidades</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_unidades" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar operadores</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_operadores" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar rutas</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_rutas" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar clientes</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_clients" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div style="border: 1px solid #cfcfcf;margin: 38px auto;"></div>
				<div class="group">
					<div class="label">Permiso de administrador</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_admin" type="checkbox" name="switch">
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="upload-data"></div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.crear_permiso').ajaxForm({
	    	url: site.url+'/system/Actions/permisos/crear.php',
	        beforeSend: function(xhr, opts) {
	        	$('.crear_camion button').prop('disabled', true);
	        	$('.upload-data').html('<div class="progress_bar"><div class="bar"></div><div class="txt"></div></div>');
	        },
	        uploadProgress: function(event, position, total, percentComplete) {
	            var percentVal = percentComplete + '%';
	            $('.progress_bar .bar').width(percentVal);
	        },
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;

	            var value = JSON.parse(xhr.responseText);
	           	if(value.status == "success")
	           	{
	           		$('.progress_bar').addClass('success');
	        		$('.progress_bar .txt').html('Guardado');

	        		pagemenu('permisos');
	           	}

	           	if(value.status == "error")
	           	{
	           		$('.progress_bar').addClass('error');
	        		$('.progress_bar .txt').html('Error');
	           	}
	           	if(value.status == "found_item")
	           	{
	           		$('.progress_bar').addClass('error');
	        		$('.progress_bar .txt').html('Ya hay un permiso con ese nombre');
	           	}
	        }
	    });
	</script>
</div>