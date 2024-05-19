<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$remolque = $sql->query("SELECT * FROM `vehiculos_remolques` WHERE id = '".$page4."'");
	if(!$remolque->num_rows)
	{
		echo "<script>pagemenu('camiones', {q: 'remolques'})</script>";
		die;
	}

	$remolque = $remolque->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('camiones', {q: 'remolques'})">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Detalles del remolque <?php echo $remolque['placa'];?>
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"><button class="btn btn-orange2" onclick="pagemenu('camiones', {q: 'remolques', d: 'editar', u: '<?php echo $remolque['id']?>'})">Editar remolque</button></div>
			<div class="column"><button class="btn btn-green2">Descargar</button></div>
		</div>
	</div>


	<div class="row" style="margin-top:35px;">
		<div class="col-md-6">
			<h6>Cert. Habilitación Vehicular</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Razón social de transportista</div></div>
						<div class="value"><?php echo $remolque['nombre'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Placa</div></div>
						<div class="value"><?php echo $remolque['placa'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Marca</div></div>
						<div class="value"><?php echo $remolque['marca'];?></div>
					</li>
				</ul>
			</div>
			<div class="group_separate"></div>
			<h6>Poliza de seguro</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Compañia</div></div>
						<div class="value"><?php echo $remolque['seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de pago poliza</div></div>
						<div class="value"><?php echo $remolque['fecha_pago_seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $remolque['fecha_seguro'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Poliza de seguro</div></div>
						<div class="value"><?php echo ($remolque['pdf_poliza_seguro'] && file_exists(FileRemolques.$remolque['folder'].'/poliza_seguro.pdf') ? '<a download="poliza_seguro" href="'.FileRemolques_site.'/'.$remolque['folder'].'/poliza_seguro.pdf'.'">Descargar</a>' : '');?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($remolque['pdf_seguro_pago'] && file_exists(FileRemolques.$remolque['folder'].'/pago_poliza_seguro.pdf') ? '<a download="pago_poliza_seguro" href="'.FileRemolques_site.'/'.$remolque['folder'].'/pago_poliza_seguro.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
			
		</div>
		
		<div class="col-md-6">
			<h6>Certificado de condiciones fisomecánicas</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Fecha de emisión</div></div>
						<div class="value"><?php echo $remolque['fecha_cond_diso_emi'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $remolque['fecha_cond_diso_ven'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($remolque['pdf_cert_fisomeca'] && file_exists(FileRemolques.$remolque['folder'].'/certificado_condiciones_fisomecanicas.pdf') ? '<a download="certificado_condiciones_fisomecanicas" href="'.FileRemolques_site.'/'.$remolque['folder'].'/certificado_condiciones_fisomecanicas.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
			<div class="group_separate"></div>
			<h6>Certificado de humos fisomecánicas</h6>
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Fecha de emisión</div></div>
						<div class="value"><?php echo $remolque['fecha_humo_diso_emi'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento</div></div>
						<div class="value"><?php echo $remolque['fecha_humo_diso_ven'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Ficha de pago</div></div>
						<div class="value"><?php echo ($remolque['pdf_cert_humofisomeca'] && file_exists(FileRemolques.$remolque['folder'].'/certificado_humos_fisomecanicas.pdf') ? '<a download="certificado_humos_fisomecanicas" href="'.FileRemolques_site.'/'.$remolque['folder'].'/certificado_humos_fisomecanicas.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>