<?php
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_unidades');
	
	$conf = $sql->query("SELECT * FROM `vehiculos_configuracion` WHERE id = '".$page4."'");
	if(!$conf->num_rows)
	{
		echo "<script>pagemenu('camiones', {q: 'configuracion'})</script>";
		die;
	}

	$conf = $conf->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('camiones', {q: 'configuracion'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar una configuración
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form id="editar_config" class="form_s" data-ajax="false" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $conf['id'];?>">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Seleccione un camión</div>
					<select name="camion" class="form-control">
						<option disabled selected>--- Sin Camión ---</option>
						<?php
						$camion = $sql->query("SELECT * FROM `vehiculos_registro` ORDER by placa_rodaje ASC");
				    	if($camion->num_rows)
				    	{
				    		while($row = $camion->fetch_array())
				    		{
				    			echo '<option value="'.$row['id'].'" '.($conf['id_vehiculo'] == $row['id'] ? 'selected' : '').'>'.$row['placa_rodaje'].'</option>';
				    		}
				    	}
						?>
					</select>
				</div>
				<div class="group">
					<div class="label">Seleccione un remolque</div>
					<select name="remolque" class="form-control">
						<option disabled selected>--- Sin Remolque ---</option>
						<?php
						$camion = $sql->query("SELECT * FROM `vehiculos_remolques` ORDER by placa ASC");
				    	if($camion->num_rows)
				    	{
				    		while($row = $camion->fetch_array())
				    		{
				    			echo '<option value="'.$row['id'].'" '.($conf['id_remolque'] == $row['id'] ? 'selected' : '').'>'.$row['placa'].'</option>';
				    		}
				    	}
						?>
					</select>
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('#editar_config').submit(function(e) {
			e.preventDefault();

			var values = $(this).serializeArray();
			if(values[0] == undefined || values[1] == undefined)
			{
				return;
			}
			values = $.param(values);

			$.ajax({
				type: 'post',
				url: `${site.url}/system/Actions/camion/conf_editar.php`,
				data: values,
				success: function(m) {
					m = JSON.parse(m);
					if (m.status == 'success') pagemenu('camiones', {q: 'configuracion'});
				}
			});
		});
	</script>
</div>