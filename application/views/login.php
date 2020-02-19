<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Sistem Informasi Kepegawaian Polines - </title>
		<link rel="shortcut icon" href="<?=base_url()?>assets/images/logo2.gif">

		<!-- Bootstrap -->
		<link href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?=base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?=base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="<?=base_url()?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="<?=base_url()?>assets/build/css/custom.min.css" rel="stylesheet">

		<script language='JavaScript'>
			var txt="Sistem Informasi Kepegawaian Polines - ";
			var speed=300;
			var refresh=null;
			function action() { document.title=txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			refresh=setTimeout("action()",speed);}action();
		</script>
	</head>

	<body class="login">
		<div>
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>

			<div class="login_wrapper">
				<div class="animate form login_form">
					<section class="login_content">
						<div>
							<img src="<?=base_url()?>assets/images/logo2.gif" width="150px" height="150px">
							<h2>
								<b>
								Sistem Informasi Kepegawaian Politeknik Semarang
								</b>
							</h2>
						</div>
						<form id="form-login" method="POST" action="<?=base_url()?>user/login">
							<h1>Silahkan Login</h1>
							<div>
								<input type="text" name="kode_pegawai" class="form-control" placeholder="Username" required="">
							</div>
							<div>
								<input type="password" name="pass_pegawai" class="form-control" placeholder="Password" required="">
							</div>
							<div>
								<button id="btn-login" class="btn btn-default form-control" type="submit">Login</button>
							</div>
							<?php
								if ($pesan !== '') {
									echo '<div id="info" class="col-md-12 col-sm-12 col-xs-12" style="fadeOut(5000)">
											<h3>
												<span id="pesan" class="btn btn-danger col-md-12 col-sm-12 col-xs-12">' .
												$pesan . '</span>
											</h3>
										</div>';
								}
							?>
							<div class="clearfix"></div>
							<div class="separator">

								<div class="clearfix"></div>
								<br />

								<div>
									<p>Sistem Informasi Kepegawaian Politeknik Semarang</p>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery.min.js"></script>
		<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery.form.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#info').fadeOut(5000);
			});
		</script>
	</body>
</html>
