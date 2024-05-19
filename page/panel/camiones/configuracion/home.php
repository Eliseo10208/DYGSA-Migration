
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de configuraciones
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('camiones', {q: 'configuracion', d: 'crear'})">Agregar nuevo</button></div>
		</div>
	</div>

	<table id="table_id" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Placa principal</th>
	            <th>Placa secundaria</th>
	            <th>Configuración</th>
	            <th>Nro de ejes</th>
	            <th>Capacidad M3</th>
	            <th>Capacidad Tn</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {?><th class="excel_clear">Editar</th><?php }?>
	            <th class="excel_clear">Eliminar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `vehiculos_configuracion`");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    			$vehicle = $sql->query("SELECT * FROM `vehiculos_registro` WHERE `id` = '".$row['id_vehiculo']."'");
	    			if($vehicle->num_rows) { $vehicle = $vehicle->fetch_assoc(); }
	    			else { $vehicle = null; }

	    			$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE `id` = '".$row['id_remolque']."'");
	    			if($remolque->num_rows) { $remolque = $remolque->fetch_assoc(); }
	    			else { $remolque = null; }
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $vehicle['placa_rodaje'];?></td>
				    <td><?php echo $remolque['placa'];?></td>
				    <td><?php echo $vehicle['configuracion'];?><?php echo $remolque['configuracion'];?></td>
				    <td><?php echo $vehicle['nro_ejes'] + $remolque['nro_ejes'];?></td>
				    <td><?php echo $vehicle['capacidad_m3'] + $remolque['cap_m3'];?></td>
				    <td><?php echo $vehicle['capacidad_tn'] + $remolque['cap_tn'];?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('camiones', {q: 'configuracion', d: 'editar', u: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Editar</button></td><?php }?>
				    <td class="excel_clear"><button class="table_buttons red" onclick="del('<?php echo $row['id']?>')"><i class="fas fa-trash"></i> Eliminar</button></td>
				</tr>
	    	<?php
	    		}
	    	}
	    	?>
	    </tbody>
	</table>

	<script type="text/javascript">
		var table = $('#table_id').DataTable({
			"order": [ 1, 'asc' ],
			"search": false,
			"paging": false,
			"info": false,
			"searching": false,
			"language": lang_table(),
			"responsive": {
	            details: {
	                type: 'column'
	            }
	        },
			"columnDefs": [ {
	            className: 'dtr-control',
	            orderable: true,
	            targets:  0
	        } ]
		});

		$('.btn_excel').click(function() {
			exportTableToExcel('table_id', 'configuracion');
		});

		function del(id) {
			var con = confirm('¿Deseas eliminar esta configuración');
			if(con == true)
			{
				$.ajax({
					type: 'post',
					url: site.url+'/system/Actions/camion/conf_eliminar.php',
					data: {id: id},
					success: function(m) {
						m = JSON.parse(m);

						pagemenu('camiones', {q: 'configuracion'});
					}
				});
			}
		}
	</script>
</div>