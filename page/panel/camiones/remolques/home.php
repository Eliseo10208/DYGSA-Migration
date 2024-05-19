
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de remolques
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('camiones', {q: 'remolques', d: 'crear'})">Agregar nuevo</button></div>
		</div>
	</div>

	<table id="table_id" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Placa</th>
	            <th>Marca</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {?><th class="excel_clear">Editar</th><?php }?>
	            <th class="excel_clear">Ver más</th>
	            <th class="excel_clear">Mto.</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `vehiculos_remolques`");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['placa']?></td>
				    <td><?php echo $row['marca']?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('camiones', {q: 'remolques', d: 'editar', u: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Editar</button></td><?php }?>
				    <td class="excel_clear"><button class="table_buttons green" onclick="pagemenu('camiones', {q: 'remolques', d: 'ver', u: '<?php echo $row['id']?>'})"><i class="far fa-eye"></i> Ver más</button></td>
				    <td class="excel_clear"><button class="table_buttons red" onclick="pagemenu('camiones', {q: 'remolques', d: 'mantenimiento', u: '<?php echo $row['id']?>'})"><i class="fas fa-cog"></i> mto</button></td>
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
			exportTableToExcel('table_id', 'lista_remolques');
		});
	</script>
</div>