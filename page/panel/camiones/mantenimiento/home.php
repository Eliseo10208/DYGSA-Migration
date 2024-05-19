<button class="back_btn" onclick="pagemenu('camiones');">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de mantenimientos <?php echo $camion['placa_rodaje'];?>
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('camiones', {q: 'mantenimiento', d: '<?php echo $camion['id'];?>', u: 'crear'})">Agregar nuevo</button></div>
		</div>
	</div>

	<table id="table_id" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Código</th>
	            <th>KM. Último</th>
	            <th>Fecha mantenimiento</th>
	            <th>Detalles</th>
	            <th>KM. prox mant.</th>
	            <th>Observaciones</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `vehiculos_mantenimiento` WHERE `vehiculo` = '".$camion['id']."'");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['codigo']?></td>
				    <td><?php echo $row['km_ultimo']?></td>
				    <td><?php echo $row['fecha_mant']?></td>
				    <td><?php echo $row['detalles']?></td>
				    <td><?php echo $row['km_prox_mant']?></td>
				    <td><?php echo $row['observaciones']?></td>
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
			"info": false,
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
			exportTableToExcel('table_id', 'mantenimiento_<?php echo $camion['placa_rodaje'];?>');
		});
	</script>
</div>