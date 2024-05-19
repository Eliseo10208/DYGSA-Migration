<button class="back_btn" onclick="pagemenu('ordencarga', {q: 'facturas', d: '<?php echo $orden['id'];?>'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar una factura en Nº <?php echo $orden['nro_manifiesto'];?>
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_factura" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<input name="orden" type="hidden" value="<?php echo $orden['id'];?>">
				<div class="group">
					<div class="label">Nº de factura</div>
					<input name="nro_factura" type="text" class="form-control" required>
				</div>
				<div class="group">
					<div class="label">Monto</div>
					<input name="monto" type="number" step="0.01" placeholder="0,00" class="form-control" required>
				</div>
				<div class="group">
					<div class="label">IVA (16%)</div>
					<input name="monto_iva" type="number" step="0.01" placeholder="0,00" class="form-control" readonly>
				</div>
				<div class="group">
					<div class="label">Retención (4%)</div>
					<input name="monto_retención" type="number" step="0.01" placeholder="0,00" class="form-control" readonly>
				</div>
				<div class="group">
					<div class="label">Total</div>
					<input name="total" type="number" step="0.01" placeholder="0,00" class="form-control" readonly>
				</div>
				<div class="group">
					<div class="label">Archivo (PDF / Imagen)</div>
					<input name="file_factura" type="file" class="form-control" accept="image/*,.pdf">
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
		$('input[name="monto"]').keyup(function() {
			monto()
		});
		$('input[name="monto"]').change(function() {
			monto()
		});
		function monto()
		{
			var monto = $('input[name="monto"]').val();
			var iva = 16 * parseFloat(monto) / 100;
			var retencion = 3 * parseFloat(monto) / 100;
			var total = parseFloat(monto) + parseFloat(iva) - parseFloat(retencion);

			$('input[name="monto_iva"]').val(iva.toFixed(2));
			$('input[name="monto_retención"]').val(retencion.toFixed(2));
			$('input[name="total"]').val(total.toFixed(2));
		}
		monto();
		$('.crear_factura').ajaxForm({
	    	url: site.url+'/system/Actions/ordencarga/facturas/crear.php',
	    	beforeSend: function(xhr, opts) {
	        	$('.upload-data').html('<div class="progress_bar"><div class="bar"></div><div class="txt"></div></div>');
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
	           		pagemenu('ordencarga', {q: 'facturas', d: '<?php echo $orden['id'];?>'})
	           	}

	           	if(value.status == "error")
	           	{
	           		$('.progress_bar').addClass('error');
	        		$('.progress_bar .txt').html('Error');
	           	}
	        }
	    });
	</script>
</div>