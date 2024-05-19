<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de permisos
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('permisos', {q: 'crear'})">Crear permiso</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nombre</th>
	            <th class="excel_clear">Editar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$lt = $sql->query("SELECT * FROM `admin_roles`");
	    	if($lt->num_rows)
	    	{
	    		while($row = $lt->fetch_array())
	    		{
	    			if($row['name'] !== 'owner' && $row['name'] !== 'user')
	    			{
	    	?>
		    	<tr>
		    		<td></td>
				   	<td><?php echo $row['name'];?></td>
				    <td><button class="table_buttons orange" onclick="pagemenu('permisos', {q: 'editar', d: '<?php echo $row['name']?>'})"><i class="fas fa-edit"></i> Editar</button></td>
				   
				</tr>
	    	<?php
	    			}
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
	</script>
</div>