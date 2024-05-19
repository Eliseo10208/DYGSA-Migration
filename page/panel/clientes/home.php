<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de clientes
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('clientes', {q: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nombre</th>
	            <th>Dirección</th>
	            <th>Distrito</th>
	            <th>Provincia</th>
	            <th>telefono</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_clients')) {?><th class="excel_clear">Modificar</th><?php }?>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `clientes`");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['nombre']?></td>
				    <td><?php echo $row['direccion']?></td>
				    <td><?php echo $row['distrito']?></td>
				    <td><?php echo $row['provincia']?></td>
				    <td><?php echo $row['telefono']?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_clients')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('clientes', {q: 'editar', d: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Modificar</button></td><?php }?>
				</tr>
	    	<?php
	    		}
	    	}
	    	?>
	    </tbody>
	</table>

	<script type="text/javascript">
		var table = $('#table_id3').DataTable({
			"order": [1, 'asc'],
			"info": false,
			"language": lang_table(),
			"responsive": {
	            "details": {
	                "type": "column"
	            }
	        },
			"columnDefs": [ {
	            "className": "dtr-control",
	            "orderable": true,
	            "targets":  0
	        } ]
		});

		$('.btn_excel').click(function() {
			exportTableToExcel('table_id3', 'clientes');
		});
	</script>
</div>