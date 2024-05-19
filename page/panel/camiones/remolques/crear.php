<button class="back_btn" onclick="pagemenu('camiones', {q: 'remolques'})">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar un remolques
			<p>Administración de transporte de carga</p>
		</div>
	</div>

	<form class="form_s crear_remolque" data-ajax="false" method="post" enctype="multipart/form-data" style="margin-top: 60px ;">
		<div class="row">
			<div class="col-md-6">
				<h4>Cert. Habilitación Vehicular</h4>

				<div class="group">
					<div class="label">Nombre o razón social del transportista</div>
					<input name="nombre_transportista" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Placa de rodaje</div>
					<input name="placa_rodaje" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Marca</div>
					<input name="marca" type="text" class="form-control">
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

				<h5>Archivos PDF</h5>
				<div class="group">
					<div class="label">Información de remolque</div>
					<input name="pdf_informacion_remolque" type="file" class="form-control" accept=".pdf">
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
		
		$('.crear_remolque').ajaxForm({
	    	url: site.url+'/system/Actions/camion/remolques/crear.php',
	        beforeSend: function(xhr, opts) {
	        	$('.crear_remolque button').prop('disabled', true);
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
	           		pagemenu('camiones', {q: 'remolques'})
	           	}
	        }
	    });
	</script>
</div>