<script>document.title = `Entrar - ${site.title}`;</script>

<div class="login-content">
	<div class="login-logo">
		<img src="<?php echo $site['url'];?>/assets/img/logo.png">
	</div>
	<h6>HOLA, Bienvenido de nuevo!</h6>
	<form data-ajax="false" class="login-form" method="post">
		<div class="resultLogin"></div>
		<div class="login-group">
			<input name="email" type="text" class="login-input" required>
			<span>Correo Electronico</span>
		</div>

		<div class="login-group">
			<input name="pass" type="password" class="login-input" required>
			<span>Contraseña</span>
			<div style="text-align: right;"><button type="button" class="btn btn_recovery">¿Olvidaste la contraseña?</button></div>
		</div>

		<div class="login-button">
			<button type="submit" class="btn btn-login">ingresar</button>
		</div>
	</form>
	<script type="text/javascript">
		$('form.login-form').submit(function(e) {
			e.preventDefault();

			var values = $(this).serializeArray();
			values[1].value = password(values[1].value);
			values = $.param(values);

			$.ajax({
				type: 'post',
				url: `${site.url}/system/Actions/login.php`,
				data: values,
				success: function(m)
				{
					m = JSON.parse(m);

					if (m.status == 'error') $('.resultLogin').html($(`<div class="alert alert-danger">${m.msg}</div>`).hide().fadeIn('fast'));
					if (m.status == 'success') page('home');
				}
			});
		});
		$('.btn_recovery').click(function() {
			$.ajax({
				url: site.url+'/page/recovery.php',
				success: function(m) {
					$('.page').html($(m).hide().fadeIn('slow'));
				}
			})
		});
	</script>
</div>