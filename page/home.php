<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!isset($client))
	{
		if($page == 'recovery')
		{
			require(Page.'recovery_page.php');
		}
		else
		{
			require(Page.'login.php');
		}
	}
	else
	{
	?>
	<script>document.title = `Panel de control - ${site.title}`;</script>

	<div class="control-container">
	<div class="control-nav">
		<div class="logo" onclick="pagemenu('home')"></div>
		<div class="nav-group">
			<div onclick="pagemenu('home')"><i class="fa fa-home"></i><div class="nav-txt">Registro de viaje</div></div>
		</div>
		<div class="nav-group">
			<div><i class="fa fa-truck"></i><div class="nav-txt">Unidades</div></div>
			<ul>
				<li onclick="pagemenu('camiones')">Vehículos</li>
				<li onclick="pagemenu('camiones', {q: 'remolques'})">Remolques</li>
				<li onclick="pagemenu('camiones', {q: 'configuracion'})">Configuracón</li>
			</ul>
		</div>
		<div class="nav-group">
			<div onclick="pagemenu('conductores')"><i class="fa fa-id-card"></i><div class="nav-txt">Operadores</div></div>
		</div>
		<div class="nav-group">
			<div onclick="pagemenu('rutas')"><i class="fa fa-road"></i><div class="nav-txt">Rutas</div></div>
		</div>
		<div class="nav-group">
			<div onclick="pagemenu('clientes')"><i class="fa fa-users"></i><div class="nav-txt">Clientes</div></div>
		</div>
		<?php if($perm->validate("permiso_maestro", "permiso_admin")){ ?>
		<div class="nav-group">
			<div><i class="fa fa-screwdriver"></i><div class="nav-txt">Administración</div></div>
			<ul>
				<li onclick="pagemenu('accesos')">Accesos</li>
				<?php if($perm->validate("permiso_maestro")){ ?>
				<li onclick="pagemenu('permisos')">Permisos</li>
				<?php }?>
			</ul>
		</div>
		<?php }?>
	</div>

	<div class="control-content">
		<div class="control-header">
			<button class="nav-bar"><i class="fa fa-bars"></i></button>
			
			<div class="control-user">
				<button class="btn"><img src="<?php echo $site['url'];?>/assets/img/photodefault.png"> <?php echo $client_panel['name']?> <i class="fas fa-caret-down"></i></button>
				<ul>
					<li onclick="pagemenu('configuracion')">Configuración</li>
					<li onclick="pagemenu('logout')">Salir</li>
				</ul>
			</div>
		</div>
		<div class="content">
			<?php 
			if(!isset($page))
			{
				require(Page.'/panel/home.php');
			}
			else
			{
				if (file_exists(Page.'/panel/'.$page.'.php'))
				{
					require(Page.'/panel/'.$page.'.php');
				}
				else
				{
					require(Page.'/panel/404.php');
				}
			}?>
		</div>
	</div>
</div>
<script type="text/javascript">
	var menu = true;
	var user = false;
	$('.nav-bar').click(function(){
		if(menu){
			$('.control-container').addClass('nav-close');
			$('.control-nav .nav-group > div').removeClass('menu_open');
			$('.control-nav .nav-group > div').parent('.nav-group').find('ul').slideUp("fast");

			menu = false;
		}else{
			$('.control-container').removeClass('nav-close');
			menu = true;
		}
	});
	$('.control-nav .nav-group > div').click(function() {
		if($(this).parent('.nav-group').find('ul').length == 0)
		{
			$('.control-nav .nav-group > div.menu_open').parent('.nav-group').find('ul').slideUp("fast");
			$('.control-nav .nav-group > div.menu_open').removeClass('menu_open');
			if(!menu)
			{
				$('.control-container').addClass('nav-close');
			}
		}
		else
		{
			if(!$(this).is('.menu_open'))
			{
				$('.control-nav .nav-group > div.menu_open').parent('.nav-group').find('ul').slideUp("fast");
				$('.control-nav .nav-group > div.menu_open').removeClass('menu_open');

				$(this).addClass('menu_open');
				$(this).parent('.nav-group').find('ul').slideDown("fast");

				if ($(window).width() > 767 ){
					if(!menu)
					{
						$('.control-container').removeClass('nav-close');
					}
				}
			}
			else
			{
				$(this).removeClass('menu_open');
				$(this).parent('.nav-group').find('ul').slideUp("fast");

				if ($(window).width() > 767 ){
					if(!menu)
					{
						$('.control-container').addClass('nav-close');
					}
				}
			}
		}
	});
	$('.control-nav .nav-group ul li').click(function(){
		if ($(window).width() > 767 )
		{
			if(!menu)
			{
				$('.control-container').addClass('nav-close');
				$('.control-nav .nav-group > div.menu_open').parent('.nav-group').find('ul').slideUp("fast");
				$('.control-nav .nav-group > div.menu_open').removeClass('menu_open');
			}
		}
		else
		{
			$('.control-container').removeClass('nav-close');
		}
		
	});
	$(document).on('mousedown', function(e){
		const modal = $('.control-container .control-nav');
		const modal2 = $('.control-user');
		if ($(window).width() <= 767 ){
			if(!modal.is(e.target) && modal.has(e.target).length === 0){$('.control-container').removeClass('nav-close');menu = true;}
		}
		if (user){
			if(!modal2.is(e.target) && modal2.has(e.target).length === 0){$('.control-user').removeClass('user-open');user = false;}
		}

	});

	$('.control-user button').click(function() {
		if(!user){
			$('.control-user').addClass('user-open');
			user = true;
		}else{
			$('.control-user').removeClass('user-open');
			user = false;
		}
	});
</script>
<?php
	}

?>