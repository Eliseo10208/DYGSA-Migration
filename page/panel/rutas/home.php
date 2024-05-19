<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de rutas
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('rutas', {q: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>KMS</th>
	            <th>Nro. peajes</th>
	            <th>Costo peaje</th>
	            <th>Combustible</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_rutas')) {?><th class="excel_clear">Modificar</th><?php }?>
	            <th class="excel_clear">Agregar peaje</th>
	            <th class="excel_clear">Ver peajes</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `rutas` ORDER by id DESC");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    			$costo = 0.00;
	    			$peajes_num = 0;
	    			$peajes = $sql->query("SELECT * FROM `rutas_peajes` WHERE `ruta` = '".$row['id']."'");
	    			if($peajes->num_rows)
	    			{
	    				while($row2 = $peajes->fetch_array())
	    				{
	    					$costo = $costo + $row2['costo'];
	    					$peajes_num++;
	    				}
	    			}

	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['origen']?></td>
				    <td><?php echo $row['destino']?></td>
				    <td><?php echo $row['kms']?></td>
				    <td><?php echo $peajes_num;?></td>
				    <td>MXN <?php echo Core::money($costo);?></td>
				    <td>MXN <?php echo Core::money($row['combustible']);?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_rutas')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('rutas', {q: 'editar', d: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Modificar</button></td><?php }?>
				    <td class="excel_clear"><button class="table_buttons green" onclick="pagemenu('rutas', {q: 'peaje', d: '<?php echo $row['id']?>', u: 'crear'})"><i class="far fa-eye"></i> Agr. peaje</button></td>
				    <td class="excel_clear"><button class="table_buttons red" onclick="pagemenu('rutas', {q: 'peaje', d: '<?php echo $row['id']?>'})"><i class="fas fa-cog"></i> Ver peaje</button></td>
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
			exportTableToExcel('table_id3', 'lista_de_camiones');
		});
	</script>
</div>