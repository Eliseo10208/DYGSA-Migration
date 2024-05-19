<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	$perm->get('permiso_maestro', 'permiso_admin', 'permiso_ordenes');

	$factura = $sql->query("SELECT * FROM `ordencarga_facturas` WHERE id = '".$page5."'");
	if(!$factura->num_rows)
	{
		echo "<script>pagemenu('ordencarga');</script>";
		die;
	}

	$factura = $factura->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('ordencarga', {q: 'facturas', d: '<?php echo $orden['id'];?>'})">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Editar una factura
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s editar_factura" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<input name="factura" type="hidden" value="<?php echo $factura['id'];?>">
				<div class="group">
					<div class="label">Nº de factura</div>
					<input name="nro_factura" type="text" class="form-control" value="<?php echo $factura['nro_factura'];?>" required>
				</div>
				<div class="group">
					<div class="label">Monto</div>
					<input name="monto" type="number" step="0.01" placeholder="0,00" value="<?php echo $factura['monto'];?>" class="form-control" required>
				</div>
				<div class="group">
					<div class="label">IVA (14%)</div>
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
					<div class="status <?php echo ($factura['file_factura'] && file_exists(FileFacturas.$factura['folder'].'/factura.'.$factura['file_type']) ? 'si' : 'no');?>"></div>
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
			var iva = 14 * parseFloat(monto) / 100;
			var retencion = 3 * parseFloat(monto) / 100;
			var total = parseFloat(monto) + parseFloat(iva) - parseFloat(retencion);

			$('input[name="monto_iva"]').val(iva.toFixed(2));
			$('input[name="monto_retención"]').val(retencion.toFixed(2));
			$('input[name="total"]').val(total.toFixed(2));
		}
		monto();
		$('.editar_factura').ajaxForm({
	    	url: site.url+'/system/Actions/ordencarga/facturas/editar.php',
	    	beforeSend: function(xhr, opts) {
	        	$('.crear_camion button').prop('disabled', true);
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
	           		$('.progress_bar').addClass('success');
	        		$('.progress_bar .txt').html('Guardado');
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