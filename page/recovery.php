<script>document.title = `Entrar - ${site.title}`;</script>

<div class="login-content">
	<div class="login-logo">
		<img src="<?php echo $site['url'];?>/assets/img/logo.png">
	</div>
	<h6>¿Olvidaste tu contraseña?</h6>
	<form data-ajax="false" class="login-form recovery_form" method="post">
		<div class="resultLogin"></div>
		<div class="login-group">
			<input name="email" type="text" class="login-input" required>
			<span>Correo Electronico</span>
		</div>

		<div class="login-button">
			<button type="submit" class="btn btn-login">Enviar solicitud</button>
		</div>

		<div style="text-align: center;margin-top: 45px;margin-bottom: -23px;"><button type="button" class="btn btn_login">Volver al inicio de sección</button></div>
	</form>
	<script type="text/javascript">
		/*$('form.recovery_form').submit(function(e) {
			e.preventDefault();
		

			$.ajax({
				type: 'post',
				url: `${site.url}/system/Actions/recovery.php`,
				data: $(this).serialize(),
				success: function(m)
				{
					m = JSON.parse(m);

					if (m.status == 'error') {
						$('.resultLogin').html($(`<div class="alert alert-danger">${m.msg}</div>`).hide().fadeIn('fast'));
						$('form.recovery_form').find('button[type="submit"]').prop('disabled', false);
					}
					if (m.status == 'success') $('.resultLogin').html($(`<div class="alert alert-success">${m.msg}</div>`).hide().fadeIn('fast'));
				}
			});
		});*/

		$('form.recovery_form').ajaxForm({
	    	url: `${site.url}/system/Actions/recovery.php`,
	        beforeSend: function(xhr, opts) {
	        	$('form.recovery_form').find('button[type="submit"]').prop('disabled', true).html(`<div class="lds-ring2"><div></div><div></div><div></div><div></div></div> Enviar solicitud`);
	        },
	        complete: function(xhr) {
	        	if(xhr.responseText == 'invalid') return;

	            var value = JSON.parse(xhr.responseText);
	           	if(value.status == "success")
	           	{
	           		$('form.recovery_form').find('button[type="submit"]').prop('disabled', true).html(`Enviar solicitud`);
	           		$('.resultLogin').html($(`<div class="alert alert-success">${value.msg}</div>`).hide().fadeIn('fast'))
	           	}

	           	if(value.status == "error")
	           	{
	           		$('.progress_bar').addClass('error');
	        		$('.progress_bar .txt').html('Error');

	        		$('form.recovery_form').find('button[type="submit"]').prop('disabled', false).html(`Enviar solicitud`);
	           	}
	        }
	    });


		$('.btn_login').click(function() {
			$.ajax({
				url: site.url+'/page/login.php',
				success: function(m) {
					$('.page').html($(m).hide().fadeIn('slow'));
				}
			})
		});
	</script>
</div>