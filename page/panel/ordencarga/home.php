<div class="panel">
	<div class="panel-header">
		<div class="title">
			Listado de ordenes de carga
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-green2 btn_excel">Descargar Excel</button></div>
			<div class="column"><button class="btn btn-primary" onclick="pagemenu('ordencarga', {q: 'crear'})">Crear nuevo</button></div>
		</div>
	</div>

	<table id="table_id3" class="display nowrap" style="width:100%">
	    <thead>
	        <tr>
	        	<th class="excel_clear"></th>
	            <th>Nº Manifiesto </th>
	            <th>F. program</th>
	            <th>Ruta</th>
	            <th>Vehículo</th>
	            <th>Conductor</th>
	            <?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {?><th class="excel_clear">Edit.</th><?php }?>
	            <th class="excel_clear">Facturas</th>
	            <th class="excel_clear">Ver más</th>
	        </tr>
	    </thead>
	    <tbody>
	    	
	    </tbody>
	</table>
	<script type="text/javascript">
		var list = []
		$(document).ready(function() {
			$('button.btn_pdf').prop('disabled', true);
			$('button.btn_excel').prop('disabled', true);

			$.ajax({
				url: site.url+'/system/Actions/ordencarga/list.php',
				beforeSend: function(){
					$('body').append($(`<div class="loadpage"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>`).hide().fadeIn('fast'));
				},
				success: function(m) {

					try {
						m = JSON.parse(m);

					if (m.list !== undefined)
					{
						list = m.list

						for (var i = 0; i < m.list.length; i++) {
							$('#table_id3').find('tbody').append(`
								<tr>
									<td></td>
									<td>${m.list[i].nro_manifiesto}</td>
									<td>${m.list[i].fecha_programacion}</td>
									<td>${m.list[i].ruta}</td>
									<td>${m.list[i].vehiculo}</td>
									<td>${m.list[i].conductor}</td>
									<?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_ordenes')) {?><td><button class="table_buttons orange" onclick="pagemenu('ordencarga', {q: 'editar', d: '${m.list[i].id}'})">Editar</button></td><?php }?>
									<td><button class="table_buttons ${(parseInt(m.list[i].factura) > 0) ? 'green' : 'orange'}" onclick="pagemenu('ordencarga', {q: 'facturas', d: '${m.list[i].id}'})">Facturas</button></td>
									<td><button class="table_buttons btn-primary" onclick="pagemenu('ordencarga', {q: 'ver', d: '${m.list[i].id}'})">Ver más</button></td>
								</tr>
							`);
						}
					}

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

					$('button.btn_pdf').prop('disabled', false);
					$('button.btn_excel').prop('disabled', false);
				
						
					} catch (error) {
						console.log("SE HA ENCONTRADO UN ERROR")
						console.log(error)
						console.log(m)
					}


				},
			complete: function(){
					$('.loadpage').fadeOut('fast', function(){
						$(this).remove();
					});
				}
			});
		});

		$('.btn_excel').click(function() {
			var column = {'nro_manifiesto': 'Nº Manifiesto', 'tn': 'Tn', 'm3': 'M3', 'bc': 'B/C', 'servicio': 'Tipo de servicio', 'ida_costo_eje': 'Costo de ida', 'vuelta_costo_eje': 'Costo de vuelta', 'fecha_programacion': 'Fecha de programación', 'fecha_presentacion': 'Fecha de presentación', 'hora_presentacion': 'Hora de presentación', 'cliente': 'Cliente', 'conductor': 'Conductor', 'conductor2': 'Conductor 2', 'vehiculo': 'Configuración', 'ruta': 'Ruta', 'lugar_carga': 'Lugar de carga', 'combustible': 'Combustible', 'carga': 'Carga', 'observacion': 'Observación'}

			var body = document.getElementsByTagName("body")[0];
			var tbl = document.createElement("table");
			var tblHead = document.createElement("thead");
			var tblBody = document.createElement("tbody");

			var tr = document.createElement('tr');
			for(var item in column) {
           		var th = document.createElement('th');
           		th.appendChild(document.createTextNode(column[item]));
      			tr.appendChild(th);
            }
            tblHead.appendChild(tr);

            for (var i = 0; i < list.length; i++) {
            	var tr = document.createElement('tr');
	            for(var item in column) {
	           		var td = document.createElement('td');
	           		td.appendChild(document.createTextNode(list[i][item]));
	      			tr.appendChild(td);
	            }
	            tblBody.appendChild(tr);
            }
            
			tbl.appendChild(tblHead);
			tbl.appendChild(tblBody);
			body.appendChild(tbl);
			tbl.setAttribute("border", "2");
			tbl.setAttribute("id", "export_table1");

			exportTableToExcel('export_table1', 'ordenes_de_carga');

			$('#export_table1').remove();
		});
	</script>
</div>