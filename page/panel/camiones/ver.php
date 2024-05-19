<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$camion = $sql->query("SELECT * FROM `vehiculos_registro` WHERE id = '".$page3."'");
	if(!$camion->num_rows)
	{
		echo "<script>pagemenu('camiones');</script>";
		die;
	}

	$camion = $camion->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('camiones');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Detalles del vehiculo <?php echo $camion['placa_rodaje'];?>
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"><?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_unidades')) {?><button class="btn btn-orange2" onclick="pagemenu('camiones', {q: 'editar', d: '<?php echo $camion['id']?>'})">Editar vehículo</button><?php }?></div>
		</div>
	</div>


	<div class="row" style="margin-top:35px;">
		<div class="col-md-6">
			<h6>Habilitación Vehicular</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Razón social de transportista</div></div>
						<div class="value"><?php echo $camion['nombre_transportista'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Nº de partida registral</div></div>
						<div class="value"><?php echo $camion['nro_partida_registral'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Placa rodaje</div></div>
						<div class="value"><?php echo $camion['placa_rodaje'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Clase de vehículo</div></div>
						<div class="value"><?php echo $camion['clase_vehiculo'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Año fabricación</div></div>
						<div class="value"><?php echo $camion['año_fabricacion'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Serie chasis</div></div>
						<div class="value"><?php echo $camion['serie_chasis'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Modelo</div></div>
						<div class="value"><?php echo $camion['modelo'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Nº de asientos</div></div>
						<div class="value"><?php echo $camion['nro_asientos'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Configuración</div></div>
						<div class="value"><?php echo $camion['configuracion'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Carroceria</div></div>
						<div class="value"><?php echo $camion['carroceria'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Nº ejes</div></div>
						<div class="value"><?php echo $camion['nro_ejes'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Capacidad M3</div></div>
						<div class="value"><?php echo $camion['capacidad_m3'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Capacidad Tn</div></div>
						<div class="value"><?php echo $camion['capacidad_tn'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Tarjeta de circulación</div></div>
						<div class="value"><?php echo ($camion['pdf_tarjeta_propiedad'] && file_exists(FileVehiculo.$camion['folder'].'/tarjeta_de_circulacion.pdf') ? '<a download="tarjeta_de_circulacion" href="'.FileVehiculo_site.'/'.$camion['folder'].'/tarjeta_de_circulacion.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<h6>Poliza de seguro</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Compañia</div></div>
						<div class="value"><?php echo $camion['seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de pago poliza</div></div>
						<div class="value"><?php echo $camion['fecha_pago_seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $camion['fecha_seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Poliza de seguro</div></div>
						<div class="value"><?php echo ($camion['pdf_poliza_seguro'] && file_exists(FileVehiculo.$camion['folder'].'/poliza_seguro.pdf') ? '<a download="poliza_seguro" href="'.FileVehiculo_site.'/'.$camion['folder'].'/poliza_seguro.pdf'.'">Descargar</a>' : '');?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($camion['pdf_seguro_pago'] && file_exists(FileVehiculo.$camion['folder'].'/pago_poliza_seguro.pdf') ? '<a download="pago_poliza_seguro" href="'.FileVehiculo_site.'/'.$camion['folder'].'/pago_poliza_seguro.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
			<div class="group_separate"></div>
			<h6>Certificado de condiciones fisomecánicas</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Fecha de emisión</div></div>
						<div class="value"><?php echo $camion['fecha_cond_diso_emi'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $camion['fecha_cond_diso_ven'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($camion['pdf_cert_fisomeca'] && file_exists(FileVehiculo.$camion['folder'].'/certificado_condiciones_fisomecanicas.pdf') ? '<a download="certificado_condiciones_fisomecanicas" href="'.FileVehiculo_site.'/'.$camion['folder'].'/certificado_condiciones_fisomecanicas.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
			<div class="group_separate"></div>
			<h6>Certificado de humos fisomecánicas</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Fecha de emisión</div></div>
						<div class="value"><?php echo $camion['fecha_humo_diso_emi'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $camion['fecha_humo_diso_ven'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($camion['pdf_cert_humofisomeca'] && file_exists(FileVehiculo.$camion['folder'].'/certificado_humos_fisomecanicas.pdf') ? '<a download="certificado_humos_fisomecanicas" href="'.FileVehiculo_site.'/'.$camion['folder'].'/certificado_humos_fisomecanicas.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>