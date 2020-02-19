<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/tittle.php"); ?>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include(__DIR__ . "/sidebar.php"); ?>
			<?php include(__DIR__ . "/top_nav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="row top_tiles">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="animated flipInY col-lg-4 col-md-4 col-sm-6">
							<div class="tile-stats">
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>
								<div id="total_pegawai" class="count">0</div>
								<h3>Pegawai</h3>
								<p>Politeknik Negeri Semarang</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
				Sistem Informasi Kepegawaian Politeknik Negeri Semarang
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>
	<?php include(__DIR__ . "/load_js.php"); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			total_pegawai();
			
			function total_pegawai(){
				var target 		= '<?=base_url()?>dashboard/total_pegawai';
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		target,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						$('#total_pegawai').html(response);
					},
					error: function(){
						$('#total_pegawai').html('0');
					}
				});
			};
		});
	</script>
</body>
</html>
