<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de operadores
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('conductores', {q: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Documento</th>
	            <th>Nombres</th>
	            <th>Categoría</th>
	            <th>Celular</th>
	            <th>Licencia</th>
	            <th>Ex. médico</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_operadores')) {?><th class="excel_clear">Editar</th><?php }?>
	            <th class="excel_clear">Ver más</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `empleados` WHERE `tipo_empleado` = 'conductor'");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['nro_licencia']?></td>
				    <td><?php echo $row['nombre']?></td>
				    <td><?php echo $row['categoria']?></td>
				    <td><?php echo $row['celular']?></td>
				    <td><?php echo $row['fecha_venc_licencia']?></td>
				    <td><?php echo $row['fecha_venc_exmedico']?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_operadores')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('conductores', {q: 'editar', d: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Editar</button></td><?php }?>
				    <td class="excel_clear"><button class="table_buttons green" onclick="pagemenu('conductores', {q: 'ver', d: '<?php echo $row['id']?>'})"><i class="far fa-eye"></i> Ver más</button></td>
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
			exportTableToExcel('table_id3', 'conductores');
		});
	</script>
</div>