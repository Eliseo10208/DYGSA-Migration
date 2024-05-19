<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$conductor = $sql->query("SELECT * FROM `empleados` WHERE id = '".$page3."'");
	if(!$conductor->num_rows)
	{
		echo "<script>pagemenu('conductores');</script>";
		die;
	}

	$conductor = $conductor->fetch_assoc();
?>
<button class="back_btn" onclick="pagemenu('conductores');">Regresar</button>
<div class="panel">
	<div class="panel-header">
		<div class="title">
			Detalles del conductor
			<p>Administración de transporte de carga</p>
		</div>
		<div class="buttons">
			<div class="column"></div>
			<div class="column"><?php if($perm->validate('permiso_maestro', 'permiso_admin', 'permiso_operadores')) {?><button class="btn btn-orange2" onclick="pagemenu('conductores', {q: 'editar', d: '<?php echo $conductor['id']?>'})">Editar conductor</button><?php }?></div>
		</div>
	</div>


	<div class="row" style="margin-top:35px;">
		<div class="col-md-6">
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Tipo de licencia</div></div>
						<div class="value"><?php echo $conductor['tipo_licencia'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Nombre</div></div>
						<div class="value"><?php echo $conductor['nombre'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de nacimiento</div></div>
						<div class="value"><?php echo $conductor['fecha_nacimiento'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Telefono</div></div>
						<div class="value"><?php echo $conductor['celular'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Dirección</div></div>
						<div class="value"><?php echo $conductor['direccion'];?></div>
					</li>
					
					<li>
						<div class="name"><div class="ct">Licencia</div></div>
						<div class="value"><?php echo ($conductor['file_licencia'] && file_exists(FileEmpleados.$conductor['folder'].'/licencia.pdf') ? '<a download="licencia" href="'.FileEmpleados_site.'/'.$conductor['folder'].'/licencia.pdf'.'">Descargar</a>' : '');?></div>
					</li>
					<li>
						<div class="name"><div class="ct">R Control</div></div>
						<div class="value"><?php echo ($conductor['file_r_control'] && file_exists(FileEmpleados.$conductor['folder'].'/r_control.pdf') ? '<a download="r_control" href="'.FileEmpleados_site.'/'.$conductor['folder'].'/r_control.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<div class="view-list">
				<ul>
					<li>
						<div class="name"><div class="ct">Nº de documento</div></div>
						<div class="value"><?php echo $conductor['nro_licencia'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Categoria</div></div>
						<div class="value"><?php echo $conductor['categoria'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento de licencia</div></div>
						<div class="value"><?php echo $conductor['fecha_venc_licencia'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento de Rcontrol</div></div>
						<div class="value"><?php echo $conductor['fecha_venc_rcontrol'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Fecha de vencimiento de examen médico</div></div>
						<div class="value"><?php echo $conductor['fecha_venc_exmedico'];?></div>
					</li>
					<li>
						<div class="name"><div class="ct">Examen médico</div></div>
						<div class="value"><?php echo ($conductor['file_examen_medico'] && file_exists(FileEmpleados.$conductor['folder'].'/examen_medico.pdf') ? '<a download="examen_medico" href="'.FileEmpleados_site.'/'.$conductor['folder'].'/examen_medico.pdf'.'">Descargar</a>' : '');?></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>