<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$rol = $sql->query("SELECT * FROM `admin_roles` WHERE name = '".$page3."'");
	if(!$rol->num_rows)
	{
		echo "<script>pagemenu('permisos');</script>";
		die;
	}

	$rol = $rol->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('permisos');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar permiso - <?php echo $rol['name'];?>
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"></div>
			<div class="column"><button class="del btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button></div>
		</div>
	</div>
	<form class="form_s edit_permiso" data-ajax="false" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $rol['name'];?>">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Permiso de modificar <br>registros de viaje</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_ordenes" type="checkbox" name="switch" <?php echo ($rol['permiso_ordenes'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar unidades</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_unidades" type="checkbox" name="switch" <?php echo ($rol['permiso_unidades'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar operadores</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_operadores" type="checkbox" name="switch" <?php echo ($rol['permiso_operadores'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar rutas</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_rutas" type="checkbox" name="switch" <?php echo ($rol['permiso_rutas'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<div class="group">
					<div class="label">Permiso de modificar clientes</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_clients" type="checkbox" name="switch" <?php echo ($rol['permiso_clients'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<?php if($rol['name'] !== "user") {?>
				<div style="border: 1px solid #cfcfcf;margin: 38px auto;"></div>
				<div class="group">
					<div class="label">Permiso de administrador</div>
					<label class="el-switch" style="font-size: 100%;">
					  <input name="permiso_admin" type="checkbox" name="switch" <?php echo ($rol['permiso_admin'] == 1) ? 'checked':'';?>>
					  <span class="el-switch-style"></span>
					</label>
				</div>
				<?php }?>
				<div class="upload-data"></div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.edit_permiso').ajaxForm({
	    	url: site.url+'/system/Actions/permisos/editar.php',
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
	    $('.del').click(function() {
	    	var con = confirm('¿Deseas eliminar el permiso - <?php echo $rol['name'];?>?');
	    	if(con == true)
	    	{
	    		$.ajax({
	    			type: 'post',
	    			url: site.url+'/system/Actions/permisos/del.php',
	    			data: {name: '<?php echo $rol['name'];?>'},
	    			success: function(m) {
	    				m = JSON.parse(m);

	    				if(m.status == 'success')
	    				{
	    					pagemenu('permisos');
	    				}
	    			}
	    		});
	    	}
	    });
	</script>
</div>