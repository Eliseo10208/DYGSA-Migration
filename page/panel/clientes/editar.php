<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_clients');
	
	$contacto = $sql->query("SELECT * FROM `clientes` WHERE `id` = '".$page3."'");
	if(!$contacto->num_rows)
	{
		echo "<script>pagemenu('clientes');</script>";
		die;
	}
	$contacto = $contacto->fetch_assoc();
?>

<button class="back_btn" onclick="pagemenu('clientes')">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar un cliente
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s editar_cliente" data-ajax="false" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $contacto['id'];?>">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Nombre</div>
					<input name="nombre" type="text" class="form-control" value="<?php echo $contacto['nombre'];?>">
				</div>
				<div class="group">
					<div class="label">Dirección</div>
					<input name="direccion" type="text" class="form-control" value="<?php echo $contacto['direccion'];?>">
				</div>
				<div class="group">
					<div class="label">Distrito</div>
					<input name="distrito" type="text" class="form-control" value="<?php echo $contacto['distrito'];?>">
				</div>
				<div class="group">
					<div class="label">Provincia</div>
					<input name="provincia" type="text" class="form-control" value="<?php echo $contacto['provincia'];?>">
				</div>
				<div class="group">
					<div class="label">Telefono</div>
					<input name="telefono" type="text" class="form-control" value="<?php echo $contacto['telefono'];?>">
				</div>
				<div class="upload-data"></div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		$('.editar_cliente').ajaxForm({
	    	url: site.url+'/system/Actions/cliente/editar.php',
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