<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	$code = $page2;

	$check = $sql->query("SELECT * FROM `recovery` WHERE `code` = '".$code."'");
	if(!$check->num_rows)
	{
		echo "<script>page('home');</script>";;

		die;
	}
	$check = $check->fetch_assoc();

?>
	<script>document.title = `Restablecer Contraseña - ${site.title}`;</script>

	<div class="login-content">
		<div class="login-logo">
			<img src="<?php echo $site['url'];?>/assets/img/logo.png">
		</div>
		<h6>Restableciendo la contraseña</h6>
		<form data-ajax="false" class="login-form change_pass" method="post">
			<input name="code" type="hidden" value="<?php echo $code;?>">
			<div class="resultLogin"></div>
			<div class="login-group">
				<input name="pass" type="password" class="login-input" required>
				<span>Nueva contraseña</span>
			</div>
			<div class="login-group">
				<input name="repass" type="password" class="login-input" required>
				<span>Repite la nueva contraseña</span>
			</div>

			<div class="login-button">
				<button type="submit" class="btn btn-login">Cambiar la contraseña</button>
			</div>
		</form>
		<script type="text/javascript">
			$('form.change_pass').submit(function(e) {
				e.preventDefault();
				
				var values = $(this).serializeArray();
				values[1].value = password(values[1].value);
				values[2].value = password(values[2].value);
				values = $.param(values);

				$.ajax({
					type: 'post',
					url: `${site.url}/system/Actions/recovery_verify.php`,
					data: values,
					success: function(m)
					{
						m = JSON.parse(m);

						if (m.status == 'error') $('.resultLogin').html($(`<div class="alert alert-danger">${m.msg}</div>`).hide().fadeIn('fast'));
						if (m.status == 'success') {
							$.ajax({
								url: site.url+'/page/login.php',
								success: function(a) {
									$('.page').html($(a).hide().fadeIn('slow'));

									$('.page').find('.resultLogin').html($(`<div class="alert alert-success">${m.msg}</div>`).hide().fadeIn('fast'));
								}
							})
						}
					}
				});
			});
		</script>
	</div>