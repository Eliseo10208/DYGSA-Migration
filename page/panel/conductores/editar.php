<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_operadores');

	$conductor = $sql->query("SELECT * FROM `empleados` WHERE id = '".$page3."'");
	if(!$conductor->num_rows)
	{
		echo "<script>pagemenu('conductores');</script>";
		die;
	}

	$conductor = $conductor->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('conductores');">Regresar</button>
<div class="panel">
	<form class="form_s editar_empleados" data-ajax="false" method="post" enctype="multipart/form-data">
		<input name="id" type="hidden" value="<?php echo $conductor['id'];?>">
		<div class="row">
			<div class="col-md-6">
				<div class="group">
					<div class="label">Nombres</div>
					<input name="nombre" type="text" class="form-control" value="<?php echo $conductor['nombre'];?>">
				</div>
				<div class="group">
					<div class="label">Fecha de nacimiento</div>
					<input name="fecha_nacimiento" type="date" class="form-control" value="<?php echo $conductor['fecha_nacimiento'];?>">
				</div>
				<div class="group">
					<div class="label">Dirección</div>
					<input name="direccion" type="text" class="form-control" value="<?php echo $conductor['direccion'];?>">
				</div>
				<div class="group">
					<div class="label">Telefono</div>
					<input name="celular" type="text" class="form-control" value="<?php echo $conductor['celular'];?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="group">
					<div class="label">Tipo de documento</div>
					<select name="tipo_doc" class="form-control">
					    <option value="Local" <?php echo ($conductor['Federal'] == 'Local' ? 'selected' : '');?>>Local</option>
					    <option value="Federal" <?php echo ($conductor['Federal'] == 'Federal' ? 'selected' : '');?>>Federal</option>
					</select>
				</div>

				<div class="group">
					<div class="label">Nº de licencia</div>
					<input name="nro_licencia" type="text" class="form-control" value="<?php echo $conductor['nro_licencia'];?>">
				</div>
				<div class="group">
					<div class="label">Categoria</div>
					<input name="categoria" type="text" class="form-control" value="<?php echo $conductor['categoria'];?>">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de licencia</div>
					<input name="fecha_venc_licencia" type="date" class="form-control" value="<?php echo $conductor['fecha_venc_licencia'];?>">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de Rcontrol</div>
					<input name="fecha_venc_rcontrol" type="date" class="form-control" value="<?php echo $conductor['fecha_venc_rcontrol'];?>">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento de examen medico</div>
					<input name="fecha_venc_exmedico" type="date" class="form-control" value="<?php echo $conductor['fecha_venc_exmedico'];?>">
				</div>

				<h5>Archivos PDF</h5>
				<div class="group">
					<div class="label">Licencia</div>
					<input name="file_licencia" type="file" class="form-control" accept=".pdf">
					<div class="status <?php echo ($conductor['file_licencia'] && file_exists(FileEmpleados.$conductor['folder'].'/licencia.pdf') ? 'si' : 'no');?>"></div>
				</div>
				<div class="group">
					<div class="label">R Control</div>
					<input name="file_r_control" type="file" class="form-control" accept=".pdf">
					<div class="status <?php echo ($conductor['file_r_control'] && file_exists(FileEmpleados.$conductor['folder'].'/r_control.pdf') ? 'si' : 'no');?>"></div>
				</div>
				<div class="group">
					<div class="label">Examen medico</div>
					<input name="file_examen_medico" type="file" class="form-control" accept=".pdf">
					<div class="status <?php echo ($conductor['file_examen_medico'] && file_exists(FileEmpleados.$conductor['folder'].'/examen_medico.pdf') ? 'si' : 'no');?>"></div>
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
		

		$('.editar_empleados').ajaxForm({
	    	url: site.url+'/system/Actions/conductores/editar.php',
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
	           	}

	           	if(value.status == "error")
	           	{
	           		$('.progress_bar').addClass('error');
	        		$('.progress_bar .txt').html('Error');
	           	}
	        }
	    });
	</script>
</div>
