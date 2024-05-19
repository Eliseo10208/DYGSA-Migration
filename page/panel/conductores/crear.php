<button class="back_btn" onclick="pagemenu('conductores');">Regresar</button>
<div class="panel">
	<form class="form_s crear_empleados" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<div class="group">
					<div class="label">Nombres</div>
					<input name="nombre" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de nacimiento</div>
					<input name="fecha_nacimiento" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Dirección</div>
					<input name="direccion" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Telefono</div>
					<input name="celular" type="text" class="form-control">
				</div>
			</div>

			<div class="col-md-6">
				<div class="group">
					<div class="label">Tipo de licencia</div>
					<select name="tipo_licencia" class="form-control">
					    <option value="Local" selected>Local</option>
					    <option value="Federal">Federal</option>
					</select>
				</div>

				<div class="group">
					<div class="label">Nº de licencia</div>
					<input name="nro_licencia" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Categoria</div>
					<input name="categoria" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de licencia</div>
					<input name="fecha_venc_licencia" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de Rcontrol</div>
					<input name="fecha_venc_rcontrol" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de examen medico</div>
					<input name="fecha_venc_exmedico" type="date" class="form-control">
				</div>

				<h5>Archivos PDF</h5>
				<div class="group">
					<div class="label">Licencia</div>
					<input name="file_licencia" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group">
					<div class="label">R Control</div>
					<input name="file_r_control" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group">
					<div class="label">Examen medico</div>
					<input name="file_examen_medico" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
				<div class="upload-data"></div>
			</div>


		</div>
	</form>
	<script type="text/javascript">
		$('.group input[type="file"]').change(function() {
			$(this).parent('.group').find('.status').removeClass('no');
			if($(this).val().length > 0)
			{
				$(this).parent('.group').find('.status').addClass('si');
			}
			else
			{
				$(this).parent('.group').find('.status').addClass('no');
			}		
		});
		
		/*$('.crear_empleados').submit(function(e){
			e.preventDefault();

			console.log($(this).serialize());
		});*/

		$('.crear_empleados').ajaxForm({
	    	url: site.url+'/system/Actions/conductores/crear.php',
	        beforeSend: function(xhr, opts) {
	        	//$('.crear_empleados button').prop('disabled', true);
	        	$('.upload-data').html('<div class="progress_bar"><div class="bar"></div></div>');
	        },
	        uploadProgress: function(event, position, total, percentComplete) {
	            var percentVal = percentComplete + '%';
	            $('.progress_bar .bar').width(percentVal);
	        },
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);
	            console.log(value);
	           	if(value.status == "success")
	           	{
	           		pagemenu('conductores', {q: 'ver', d: value.id});
	           	}
	        }
	    });
	</script>
</div>
