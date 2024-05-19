<button class="back_btn" onclick="pagemenu('rutas');">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de peajes
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('rutas', {q: 'peaje', d: '<?php echo $peaje['id'];?>', u: 'crear'})">Agregar nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nombre</th>
	            <th>Ubicación</th>
	            <th>Costo</th>
	            <th>IDA / VUELA</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `rutas_peajes` WHERE `ruta` = '".$peaje['id']."' ORDER by id DESC");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['nombre']?></td>
				    <td><?php echo $row['ubicacion']?></td>
				    <td><?php echo Core::money($row['costo']);?></td>
				    <td>MXN <?php echo Core::money($row['costo'] * 2);?></td>
				</tr>
	    	<?php
	    		}
	    	}
	    	?>
	    </tbody>
	</table>
	<script type="text/javascript">
		var table = $('#table_id3').DataTable({
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
			exportTableToExcel('table_id3', 'peajes_ruta_<?php echo $peaje['id'];?>');
		});
	</script>
</div>