<button class="back_btn" onclick="pagemenu('clientes')">Regresar</button>

<div class="panel">
	<div class="panel-header">
		<div class="title">
			Agregar un nuevo cliente
			<p>Administración de transporte de carga</p>
		</div>
	</div>
	<form class="form_s crear_cliente" data-ajax="false" method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="group">
					<div class="label">Nombre</div>
					<input name="nombre" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Dirección</div>
					<input name="direccion" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Distrito</div>
					<input name="distrito" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Provincia</div>
					<input name="provincia" type="text" class="form-control">
				</div>
				<div class="group">
					<div class="label">Telefono</div>
					<input name="telefono" type="text" class="form-control">
				</div>
				<div class="submit"><button type="submit" class="btn btn-success">Guardar datos</button></div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		$('.crear_cliente').ajaxForm({
			url: site.url + '/system/Actions/cliente/crear.php',
			complete: function (xhr) {
				const val = xhr.responseText
				try {
					if (xhr.responseText == 'invalid') return;

				var value = JSON.parse(xhr.responseText);
				console.log(value)
				if (value.status == "success") {
					pagemenu('clientes');
				}
				} catch (error) {
					console.log("se ha detectado un error",error)
					console.log(val)
				}
			}
		});

	</script>
</div>