<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$con = $sql->query("SELECT * FROM `clientes_contactos` WHERE `id` = '".$page5."'");
	if(!$con->num_rows)
	{
		echo "<script>pagemenu('clientes', {q: 'contacto', d: '".$contacto['id']."'})</script>";
		die;
	}
	$con = $con->fetch_assoc();
?>


<button class="back_btn" onclick="pagemenu('clientes', {q: 'contacto', d: '<?php echo $contacto['id']?>'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar un contacto
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_cliente" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<input type="hidden" name="id" value="<?php echo $con['id']?>">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Documento</div>
					<input name="doc" type="text" class="form-control" value="<?php echo $con['doc'];?>">
				</div>
				<div class="group">
					<div class="label">Nombre</div>
					<input name="nombre" type="text" class="form-control" value="<?php echo $con['nombre'];?>">
				</div>
				<div class="group">
					<div class="label">Cargo</div>
					<input name="cargo" type="text" class="form-control" value="<?php echo $con['cargo'];?>">
				</div>
				<div class="group">
					<div class="label">Celular</div>
					<input name="celular" type="text" class="form-control" value="<?php echo $con['celular'];?>">
				</div>
				<div class="group">
					<div class="label">Celular 2</div>
					<input name="celular2" type="text" class="form-control" value="<?php echo $con['celular2'];?>">
				</div>
				<div class="upload-data"></div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		$('.crear_cliente').ajaxForm({
	    	url: site.url+'/system/Actions/cliente/contacto/editar.php',
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