<button class="back_btn" onclick="pagemenu('camiones');">Regresar</button>
<div class="panel">
	<form class="form_s crear_camion" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<h4>Habilitación Vehicular</h4>
				<div class="group">
					<div class="label">Nombre o razón social del transportista</div>
					<input name="nombre_transportista" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Nro de partida registral</div>
					<input name="nro_partida_registral" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Placa de rodaje</div>
					<input name="placa_rodaje" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Clase de vehículo</div>
					<input name="clase_vehiculo" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Nro ejes</div>
					<input name="nro_ejes" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Año fabricación</div>
					<input name="año_fabricacion" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Número o serie del chasis</div>
					<input name="serie_chasis" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Modelo</div>
					<input name="modelo" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Nro de asientos</div>
					<input name="nro_asientos" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Configuración</div>
					<input name="configuracion" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Carrocería</div>
					<input name="carroceria" type="text" class="form-control">
				</div>
				<h5>Adicionales</h5>
				<div class="group">
					<div class="label">Capacidad M3</div>
					<input name="capacidad_m3" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Capacidad Tn</div>
					<input name="capacidad_tn" type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<h5>Poliza de seguro</h5>
				<div class="group">
					<div class="label">Compañia</div>
					<input name="seguro_compañia" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de pago poliza</div>
					<input name="fecha_pago_seguro" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento</div>
					<input name="fecha_seguro" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Poliza de seguro</div>
					<input name="pdf_poliza_seguro" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group">
					<div class="label">Ficha de pago</div>
					<input name="pdf_seguro_pago" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group_separate"></div>
				<h5>Certificado de condiciones fisomecánicas</h5>
				<div class="group">
					<div class="label">Fecha de emisión</div>
					<input name="fecha_cond_diso_emi" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento</div>
					<input name="fecha_cond_diso_ven" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Certificado</div>
					<input name="pdf_cert_fisomeca" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group_separate"></div>
				<h5>Certificado de humos fisomecánicas</h5>
				<div class="group">
					<div class="label">Fecha de emisión</div>
					<input name="fecha_humo_diso_emi" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Fecha de vencimiento</div>
					<input name="fecha_humo_diso_ven" type="date" class="form-control">
				</div>
				<div class="group">
					<div class="label">Certificado</div>
					<input name="pdf_cert_humofisomeca" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="group_separate"></div>
				<h5>Archivos PDF</h5>
				<div class="group">
					<div class="label">Tarjeta de circulación</div>
					<input name="pdf_tarjeta_propiedad" type="file" class="form-control" accept=".pdf">
					<div class="status no"></div>
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
				<div class="upload-data"></div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$('.group input[type="file"]').change(function() {
			$(this).parent('.group').find('.status').removeClass('no');
			if($(this).val().length > 0)
			{
				$(this).parent('.group').find('.status').addClass('si');
			}
			else
			{
				$(this).parent('.group').find('.status').addClass('no');
			}		
		});
		
		$('.crear_camion').ajaxForm({
	    	url: site.url+'/system/Actions/camion/crear.php',
	        beforeSend: function(xhr, opts) {
	        	$('.crear_camion button').prop('disabled', true);
	        	$('.upload-data').html('<div class="progress_bar"><div class="bar"></div></div>');
	        },
	        uploadProgress: function(event, position, total, percentComplete) {
	            var percentVal = percentComplete + '%';
	            $('.progress_bar .bar').width(percentVal);
	        },
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;
	        	
	            var value = JSON.parse(xhr.responseText);
	           	if(value.status == "success")
	           	{
	           		pagemenu('camiones', {q: 'ver', d: value.id});
	           	}
	        }
	    });
	</script>
</div>