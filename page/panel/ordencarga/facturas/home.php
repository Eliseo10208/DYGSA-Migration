<button class="back_btn" onclick="pagemenu('ordencarga');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Listado de facturas de Nº <?php echo $orden['nro_manifiesto'];?>
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('ordencarga', {q: 'facturas', d: '<?php echo $orden['id'];?>', u: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nº Factura</th>
	            <th>Monto</th>
	            <th>IVA (16%)</th>
	            <th>Retención (4%)</th>
	            <th>Total</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {?><th class="excel_clear">Edit.</th><?php }?>
	            <th class="excel_clear">Descargar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `ordencarga_facturas` ORDER by id DESC");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['nro_factura']?></td>
				    <td>MXN <?php echo Core::money($row['monto']);?></td>
				    <td>MXN <?php echo Core::money($row['monto_iva']);?></td>
				    <td>MXN <?php echo Core::money($row['monto_retención']);?></td>
				    <td>MXN <?php echo Core::money($row['total']);?></td>
				    <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {?><td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('ordencarga', {q: 'facturas', d: '<?php echo $orden['id'];?>', u: 'editar', c: '<?php echo $row['id'];?>'})"><i class="fas fa-edit"></i> Editar</button></td><?php }?>
				    <td class="excel_clear"><?php echo ($row['file_factura'] && file_exists(FileFacturas.$row['folder'].'/factura.'.$row['file_type']) ? '<a class="table_buttons red" download="factura" href="'.FileFacturas_site.'/'.$row['folder'].'/factura.'.$row['file_type'].'">Descargar</a>' : '');?></td>
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
			"columnDefs": [{
	            "className": "dtr-control",
	            "orderable": true,
	            "targets":  0
	        }]
		});
		$('.btn_excel').click(function() {
			exportTableToExcel('table_id3', 'facturas_<?php echo $orden['nro_manifiesto'];?>');
		});
	</script>
</div>