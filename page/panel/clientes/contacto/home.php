<button class="back_btn" onclick="pagemenu('clientes')">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de contacto
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('clientes', {q: 'contacto', d: '<?php echo $contacto['id']?>', u: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	        	<th>Documento</th>
	            <th>Nombre</th>
	            <th>Cargo</th>
	            <th>Celular</th>
	            <th>Celular 2</th>
	            <th class="excel_clear">Modificar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `clientes_contactos` WHERE `cliente` = '".$contacto['id']."'");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    	?>
		    	<tr>
		    		<td class="excel_clear"></td>
				    <td><?php echo $row['doc']?></td>
				    <td><?php echo $row['nombre']?></td>
				    <td><?php echo $row['cargo']?></td>
				    <td><?php echo $row['celular']?></td>
				    <td><?php echo $row['celular2']?></td>
				    <td class="excel_clear"><button class="table_buttons orange" onclick="pagemenu('clientes', {q: 'contacto', d: '<?php echo $row['id']?>', u: 'editar', c: '<?php echo $row['id'];?>'})"><i class="fas fa-edit"></i> Modificar</button></td>
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
			exportTableToExcel('table_id3', 'lista_de_contacto');
		});
	</script>
</div>