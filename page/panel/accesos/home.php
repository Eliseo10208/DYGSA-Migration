<div class="panel">
	<div class="panel-header">
		<div class="title">
			Lista de accesos
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('accesos', {q: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nombre</th>
	            <th>Correo</th>
	            <th>Permiso</th>
	            <th>Registro</th>
	            <th class="excel_clear">Modificar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$acceso = $sql->query("SELECT * FROM `admin_users`");
	    	if($acceso->num_rows)
	    	{
	    		$roles = $perm->get_roles();
	    		while($row = $acceso->fetch_array()) {
	    			$rol = $roles[$row['rol']];
	    			if($client_panel['id'] !== $row['id'] && $rol['permiso_maestro'] == 0)
	    			{
	    	?>
	    		<tr>
	    			<td></td>
	    			<td><?php echo $row['name'];?></td>
	    			<td><?php echo $row['email'];?></td>
	    			<td><?php echo $row['rol'];?></td>
	    			<td><?php echo date('d-m-Y', $row['registerdate']);?></td>
	    			<td><?php if($perm->validate('permiso_maestro') || $rol['permiso_admin'] == 0){?><button class="table_buttons orange" onclick="pagemenu('accesos', {q: 'editar', d: '<?php echo $row['id']?>'})"><i class="fas fa-edit"></i> Modificar</button><?php }?></td>
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
	</script>
</div>