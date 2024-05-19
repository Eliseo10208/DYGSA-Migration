<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_ordenes');
	
	$orden = $sql->query("SELECT * FROM `ordencarga` WHERE id = '".$page3."'");
	if(!$orden->num_rows)
	{
		echo "<script>pagemenu('ordencarga');</script>";
		die;
	}

	$orden = $orden->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('ordencarga');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar una orden de carga
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s editar_ordencarga" data-ajax="false" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $orden['id'];?>">
		<div class="row">
			<div class="col-md-6">
				<div class="group">
					<div class="label">Nº manifiesto</div>
					<input name="nro_manifiesto" type="text" class="form-control" value="<?php echo $orden['nro_manifiesto'];?>">
				</div>
				<div class="group">
					<div class="label">Cliente (*)</div>
					<select name="cliente" class="form-control">
						<option selected disabled>--- Selecciona un cliente ---</option>
						<?php 
						$cliente = $sql->query("SELECT * FROM `clientes`");
						if($cliente->num_rows)
						{
							while($row = $cliente->fetch_array()) {
								echo '<option value="'.$row['id'].'"'.($orden['cliente'] == $row['id'] ? 'selected' : '').'>'.$row['nombre'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="group">
					<div class="label">Tn</div>
					<input name="tn" type="number" class="form-control" value="<?php echo $orden['tn'];?>">
				</div>
				<div class="group">
					<div class="label">M3</div>
					<input name="m3" type="number" class="form-control" value="<?php echo $orden['m3'];?>">
				</div>
				<div class="group">
					<div class="label">B/C</div>
					<input name="bc" type="number" class="form-control" value="<?php echo $orden['bc'];?>">
				</div>
				<h5>Datos Importantes</h5>
				<div class="group">
					<div class="label">Tipo de servicio</div>
					<select name="servicio" class="form-control" >
						<option selected disabled>--- Selecciona un servicio ---</option>
						<option value="local" <?php echo ($orden['servicio'] == 'local' ? 'selected' : '');?>>Local</option>
						<option value="transferencia" <?php echo ($orden['servicio'] == 'transferencia' ? 'selected' : '');?>>Transferencia</option>
						<option value="nacional" <?php echo ($orden['servicio'] == 'nacional' ? 'selected' : '');?>>Nacional</option>
					</select>
				</div>
				<div class="group">
					<div class="label">Conductor (*)</div>
					<select name="conductor" class="form-control">
						<option selected disabled>--- Selecciona un conductor ---</option>
						<?php 
						$conductor = $sql->query("SELECT * FROM `empleados` WHERE `tipo_empleado` = 'conductor'");
						if($conductor->num_rows)
						{
							while($row = $conductor->fetch_array()) {
								echo '<option value="'.$row['id'].'" '.($orden['conductor'] == $row['id'] ? 'selected' : '').'>'.$row['nombre'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="group">
					<div class="label">Segundo conductor</div>
					<select name="segundo_conductor" class="form-control" >
						<option selected disabled>--- Selecciona un conductor ---</option>
						<?php 
						$conductor = $sql->query("SELECT * FROM `empleados` WHERE `tipo_empleado` = 'conductor'");
						if($conductor->num_rows)
						{
							while($row = $conductor->fetch_array()) {
								echo '<option value="'.$row['id'].'" '.($orden['conductor2'] == $row['id'] ? 'selected' : '').'>'.$row['nombre'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="group">
					<div class="label">Vehículo (*)</div>
					<select name="camion" class="form-control" >
						<option selected disabled>--- Selecciona un camión ---</option>
						<?php 
						$vehicle = $sql->query("SELECT * FROM `vehiculos_configuracion`");
						if($vehicle->num_rows)
						{
							while($row = $vehicle->fetch_array()) {
								$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE `id` = '".$row['id_vehiculo']."'");
								$camion = $camion->fetch_assoc();
								$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE `id` = '".$row['id_remolque']."'");
								$remolque = $remolque->fetch_assoc();
								echo '<option value="'.$row['id'].'" '.($orden['vehiculo'] == $row['id'] ? 'selected' : '').'>'.$camion['placa_rodaje'].$remolque['placa'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="group">
					<div class="label">Ruta (*)</div>
					<select name="ruta" class="form-control">
						<option selected disabled>--- Selecciona una ruta ---</option>
						<?php 
						$rutas = $sql->query("SELECT * FROM `rutas`");
						if($rutas->num_rows)
						{
							while($row = $rutas->fetch_array()) {
								echo '<option value="'.$row['id'].'" '.($orden['ruta'] == $row['id'] ? 'selected' : '').'>'.$row['origen'].' - '.$row['destino'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<h5>Ruta ida</h5>
				<div class="group">
					<div class="label">Costo por eje (*)</div>
					<input name="ida_costo_eje" type="number" step="0.01" class="form-control" value="<?php echo $orden['ida_costo_eje'];?>" required>
				</div>
				<h5>Ruta vuelta</h5>
				<div class="group">
					<div class="label">Costo por eje (*)</div>
					<input name="vuelta_costo_eje" type="number" step="0.01" class="form-control" value="<?php echo $orden['vuelta_costo_eje'];?>" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="group">
					<div class="label">Fecha programación (*)</div>
					<input name="fecha_programacion" type="date" class="form-control" value="<?php echo $orden['fecha_programacion'];?>" required>
				</div>
				<div class="group">
					<div class="label">Fecha presentación (*)</div>
					<input name="fecha_presentacion" type="date" class="form-control" value="<?php echo $orden['fecha_presentacion'];?>" required>
				</div>
				<div class="group">
					<div class="label">Hora presentación (*)</div>
					<input name="hora_presentacion" type="time" class="form-control" value="<?php echo $orden['hora_presentacion'];?>" required>
				</div>
				<div class="group">
					<div class="label">Lugar de carga (*)</div>
					<input name="lugar_carga" type="text" class="form-control" value="<?php echo $orden['lugar_carga'];?>" required>
				</div>
				<div class="group">
					<div class="label">Combustible (*)</div>
					<input name="combustible" type="text" class="form-control" value="<?php echo $orden['combustible'];?>" required>
				</div>
				<div class="group">
					<div class="label">Carga (*)</div>
					<input name="carga" type="text" class="form-control" value="<?php echo $orden['carga'];?>" required>
				</div>
				<div class="group">
					<div class="label">Observación</div>
					<textarea name="observacion" class="form-control" rows="4"><?php echo $orden['observacion'];?></textarea>
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
				<div class="upload-data"></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.editar_ordencarga').ajaxForm({
	    	url: site.url+'/system/Actions/ordencarga/editar.php',
	        beforeSend: function(xhr, opts) {
	        	var values = $('.editar_ordencarga').serializeArray();

		    	var servicio = values.find((element) => element.name == "servicio");
		    	var conductor = values.find((element) => element.name == "conductor");
		    	var cliente = values.find((element) => element.name == "cliente");
		    	var camion = values.find((element) => element.name == "camion");
		    	var ruta = values.find((element) => element.name == "ruta");

				if(servicio == undefined || conductor == undefined || cliente == undefined || camion == undefined || ruta == undefined)
				{
					xhr.abort();
				}
				else
				{
	        		$('.crear_camion button').prop('disabled', true);
	        		$('.upload-data').html('<div class="progress_bar"><div class="bar"></div><div class="txt"></div></div>');
				}
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