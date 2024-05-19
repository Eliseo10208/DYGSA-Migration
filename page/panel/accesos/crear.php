<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$roles = $perm->get_roles();
?>

<button class="back_btn" onclick="pagemenu('accesos')">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agrear un nuevo acceso
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<div class="form_s">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<form class="crear_acceso" data-ajax="false" method="post" enctype="multipart/form-data">
					<div class="group">
						<div class="label">Nombre:</div>
						<input type="text" class="form-control" name="nombre" required>
					</div>
					<div class="group">
						<div class="label">Apellido:</div>
						<input type="text" class="form-control" name="apellido" required>
					</div>
					<div class="group">
						<div class="label">Correo:</div>
						<input type="email" class="form-control" name="email" required>
					</div>
					<div class="group">
						<div class="label">Permiso:</div>
						<select name="permiso" class="form-control">
							<option disabled selected>--- Selecciona un permiso ---</option>
							<?php
							foreach ($roles as $key => $value) {
								if($value['permiso_maestro'] == 0)
								{
									if($value['permiso_admin'] == 0 || $value['permiso_admin'] == 1 && $perm->validate('permiso_maestro'))
									{
										echo '<option value="'.$key.'" '.($key == 'user' ? 'selected' : '').'>'.$key.'</option>';
									}
								}
							}
							?>
						</select>
					</div>
					
					<div class="submit"><button type="submit" class="btn btn-success">Crear acceso</button></div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('.crear_acceso').submit(function(e) {
			e.preventDefault();

			var values = $(this).serializeArray();
	    	var permiso = values.find((element) => element.name == "permiso");

	    	if (permiso == undefined) return;

	    	$.ajax({
	    		type: 'post',
	    		url: site.url+'/system/Actions/accesos/crear.php',
	    		data: $(this).serialize(),
	    		success: function(m) {
	    			m = JSON.parse(m);

	    			if(m.status == "success")
	    			{
	    				pagemenu('accesos');
	    			}
	    		}
	    	});
		});
	
	</script>
</div>