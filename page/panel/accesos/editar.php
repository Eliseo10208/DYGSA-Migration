<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$roles = $perm->get_roles();
	$acceso = $sql->query("SELECT * FROM `admin_users` WHERE `id` = '".$page3."'");
	if(!$acceso->num_rows)
	{
		echo "<script>pagemenu('accesos');</script>";
		die;
	}

	$acceso = $acceso->fetch_assoc();
	$rol = $roles[$acceso['rol']];

	if(!$perm->validate('permiso_maestro') && $rol['permiso_admin'] == 1 || $client_panel['id'] == $acceso['id'])
	{
		echo "<script>pagemenu('accesos');</script>";
		die;
	}
?>
<button class="back_btn" onclick="pagemenu('accesos')">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar acceso
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"></div>
			<div class="column"><button class="btn btn-danger del_btn"><i class="fa fa-trash"></i> Eliminar</button></div>
		</div>
	</div>
	<div class="form_s">
		<div class="row">
			<div class="col-md-6">
				<form class="editar_acceso" data-ajax="false" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $acceso['id'];?>">
					<div class="group">
						<div class="label">Nombre:</div>
						<input type="text" name="nombre" class="form-control" value="<?php echo $acceso['name']?>">
					</div>
					<div class="group">
						<div class="label">Apellido:</div>
						<input type="text" name="apellido" class="form-control" value="<?php echo $acceso['lastname']?>">
					</div>
					<div class="group">
						<div class="label">Permiso:</div>
						<select name="permiso" class="form-control">
							<?php
							foreach ($roles as $key => $value) {
								if($value['permiso_maestro'] == 0)
								{
									if($value['permiso_admin'] == 0 || $value['permiso_admin'] == 1 && $perm->validate('permiso_maestro'))
									{
										echo '<option value="'.$key.'" '.($acceso['rol'] == $key ? 'selected' : '').'>'.$key.'</option>';
									}
								}
							}
							?>
						</select>
					</div>
					
					<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
					<div class="upload-data"></div>
				</form>
			</div>
			<div class="col-md-6">
				<h5>Cambiar contraseña</h5>
				<form class="form_s editar_password" data-ajax="false" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $acceso['id'];?>">
					<div class="group">
						<div class="label">Contraseña</div>
						<input name="password" type="password" class="form-control" required>
					</div>
					<div class="group">
						<div class="label">Confirmar Contraseña</div>
						<input name="repassword" type="password" class="form-control" required>
					</div>
					<div class="submit"><button type="submit" class="btn btn-primary">Cambiar contraseña</button></div>
					<div class="upload-data2"></div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('.editar_acceso').ajaxForm({
	    	url: site.url+'/system/Actions/accesos/editar.php',
	        beforeSend: function(xhr, opts) {
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

	    $('.editar_password').submit(function(e) {
	    	e.preventDefault();

	    	var values = $(this).serializeArray();
			values[1].value = password(values[1].value);
			values[2].value = password(values[2].value);
			values = $.param(values);

			$.ajax({
				type:'post',
				url: site.url+'/system/Actions/accesos/pass.php',
				data: values,
				success: function(e) {
    				e = JSON.parse(e);

    				if(e.status == 'success'){
    					$('.upload-data2').html('<div class="progress_bar success"><div class="bar"></div><div class="txt"></div></div>');
    					$('.upload-data2').find('.bar').width(100+'%');
    					$('.upload-data2').find('.txt').html('Guardado');
    				}

    				if(e.status == "error")
		           	{
		           		$('.upload-data2').html('<div class="progress_bar error"><div class="bar"></div><div class="txt"></div></div>');
    					$('.upload-data2').find('.bar').width(100+'%');
    					$('.upload-data2').find('.txt').html('Error');
		           	}
		           	if(e.status == "error_no_coincide")
		           	{
		           		$('.upload-data2').html('<div class="progress_bar error"><div class="bar"></div><div class="txt"></div></div>');
    					$('.upload-data2').find('.bar').width(100+'%');
    					$('.upload-data2').find('.txt').html('No coinciden');
		           	}

    			}
			});
	    });

	    $('.del_btn').click(function() {
	    	var con = confirm('¿Deseas eliminar este acceso?');
	    	if(con == true)
	    	{
	    		$.ajax({
	    			type: 'post',
	    			url: site.url+'/system/Actions/accesos/delete.php',
	    			data: {id: '<?php echo $acceso['id'];?>'},
	    			success: function(e) {
	    				e = JSON.parse(e);

	    				if(e.status == 'success'){
	    					pagemenu('accesos');
	    				}
	    			}
	    		});
	    	}
	    });
	</script>
</div>