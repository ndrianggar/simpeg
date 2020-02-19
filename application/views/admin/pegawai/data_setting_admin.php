<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../tittle.php"); ?>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include(__DIR__ . "/../sidebar.php"); ?>
			<?php include(__DIR__ . "/../top_nav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<a href="<?=base_url()?>">
										<i class="fa fa-home"></i>
									</a> \ 
									<a href="#">
										<?=$this->session->userdata('nama_pegawai_siskap')?>
									</a>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<br/>
								<form name="form-ganti" id="form-ganti" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
									<div class="form-group text-center">
										<div class="col-md-12 col-sm-12 col-xs-12 ">
											<img src="<?php echo base_url('/assets/images/user.png'); ?>" class="photo_profile" alt="profile" style="width: 150px; height: 150px; border-radius: 50%;">
										</div>
									</div>
								</form>
								
								<br/>
								<br/>
								<br/>

								<form name="form-simpan" id="form-simpan" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?=base_url()?>setting/edit">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-2 col-sm-12 col-xs-12">
											</div>
											<div class="col-md-10 col-sm-12 col-xs-12">
												<div class="form-group">
													<label class="col-md-2 col-sm-2 col-xs-12 label-control">ID Pegawai</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="id" name="id" class="form-control" placeholder="Id Pegawai" type="hidden">
														<input id="id_pegawai" name="id_pegawai" class="form-control" disabled="disabled" placeholder="Id Pegawai">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 col-sm-2 col-xs-12 label-control">Nama </label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="nama" name="nama" class="form-control" placeholder="Nama Pegawai" required="required">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 col-sm-2 col-xs-12 label-control">E-mail </label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="email" name="email" class="form-control" placeholder="E-mail Pegawai" required="required">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													</div>
												</div>
												<div class="form-group" style="display: none;">
													<label class="col-md-2 col-sm-2 col-xs-12 label-control">Password</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="password" name="password" class="form-control" placeholder="Password">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													</div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<br>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-2 col-sm-12 col-xs-12">
												<button type="button" id="btn-ganti" class="btn btn-default">Ganti Password</button>
											</div>
											<div class="col-md-9 col-sm-12 col-xs-12">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12" style="display: none;">
												<button type="button" id="btn-simpan" class="btn btn-primary">Simpan</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- Tampilan "model-tambah" -->
						<div class="modal fade" id="modalChangePass">
							<form id="form1"  action="">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Password Baru</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<input id="id_pegawai_ganti" name="id" type="hidden">
														<input type="password" id="password" name="password" class="form-control" placeholder="Password Baru" required="required">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
														<button type=button id="show" class="btn btn-default btn-sm" onclick="ShowPassword()"><i class="fa fa-eye"></i></button>
														<button type=button style="display:none" class="btn btn-default btn-sm" id="hide"  onclick="HidePassword()"><i class="fa fa-eye-slash"></i></button>
													</div>		
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Konfirmasi Password</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<input type="password" id="password1" name="password1" class="form-control" placeholder="Konfirmasi Password" required="required">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
														<button type=button id="show2" class="btn btn-default btn-sm" onclick="ShowPassword2()"><i class="fa fa-eye"></i></button>
														<button type=button style="display:none" class="btn btn-default btn-sm" id="hide2"  onclick="HidePassword2()"><i class="fa fa-eye-slash"></i></button>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<div class="btn-group">
												<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
												<button id="btnSave" onclick="simpanPassword()" class="btn btn-success" type="button">Simpan</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- Tampilan "model-tambah" -->

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
	<?php include(__DIR__ . "/../load_js.php"); ?>
	<script>
		$(document).ready(function(){
			data_profil();

			$('#ganti_foto').click(function(){
				$('#form-ganti').attr('action','<?=base_url()?>profil/ganti_foto');
				$('#modal-ganti-foto').modal('show');
			});

			$('#btn-simpan').click(function() {
				$('#form-simpan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							swal('Edit Data Sukses');
							var url = "<?=base_url()?>setting/";
							window.location.href = url;
						}else{
							swal('Edit Data Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#btn-ganti').on('click', function(){
				save_method = 'pass';
				var id_pegawai 	= $('#id').val();
				$('#form1')[0].reset();
				$('#id_pegawai_ganti').val(id_pegawai);
				$('.form-group').removeClass('has-error').removeClass('has-success');
				$('.text-danger').remove();
				$('#modalChangePass').modal('show');
			});

			$('#btn-password').click(function(){
				$('#form1').attr('action','<?=base_url()?>profil/ganti_password');
				$('#modalChangePass').modal('show');
		
			});

			// $('#tambah-ganti-password').click(function() {
			// 	$('#form-password').ajaxForm({
			// 		success: 	function(response){
			// 			if(response=='true'){
			// 				swal('Ganti Password Sukses');
			// 				$('#form-password')[0].reset();
			// 				$('#modal-password').modal('hide');
			// 			}else{
			// 				swal('Ganti Password Gagal');
			// 			}
			// 		},
			// 		error: function(){
			// 			swal('ERROR : function(response)');
			// 		}
			// 	}).submit();
			// });

			$('#btn-batal-ganti').on('click', function(){
				var url = "<?=base_url()?>profil/";
				window.location.href = url;
			});


			$('#foto_petugas').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>2000000){
					swal ('Size terlalu besar');
					$('#foto_petugas').val('');
				} else {
					readURL(this);
				}
			});

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
					$('#PrevFoto').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
				}
			};

		});

		function data_profil()
		{
			$.ajax({
				url : "<?php echo site_url('setting/data_list')?>",
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('#id').val(data.id_pegawai);
					$('#id_pegawai').val(data.kd_pegawai);
					$('#nama').val(data.nm_pegawai);
					$('#email').val(data.email_pegawai);
					$('#password').val(data.pass_pegawai);
					if(data.foto_pegawai == null || data.foto_pegawai == '') {
						$('.photo_profile').attr('src','<?php echo base_url('/assets/images/user.png'); ?>');
					}
					else
					{
						$('.photo_profile').attr('src','<?php echo base_url('/assets/foto/'); ?>'+data.foto_pegawai);
					}
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax');
				}
			});
		}

	function simpanPassword()
	{
		$('#btnSave').text('Menyimpan...');
		$('#btnSave').attr('disabled',true);

		$.ajax({
			url : "<?php echo site_url('reset/changePasswd')?>",
			type: "POST",
			data: $('#form1').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status == true)
				{
					$('#modalChangePass').modal('hide');

					$('.form-group').removeClass('has-error').removeClass('has-success');
					$('.text-danger').remove();

					alertResult('Sukses', 'success', 'Sukses mengubah password');

				}
				else
				{
					$.each(data.messages, function(key, value) 
					{
					var element = $('#' + key);

					element.closest('div.form-group')
					.removeClass('has-error')
					.addClass(value.length > 0 ? 'has-error' : 'has-success')
					.find('.text-danger')
					.remove();

					element.after(value);
					});
				}
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled',false);

			},
			error: function (jqXHR, textStatus, errorThrown)
			{

				//cek lagi
				alertResult('Gagal' ,'error', 'Gagal menambah / mengubah data');
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled',false);
			}
		});
	}

	function ShowPassword()
	{
		if(document.getElementById("password").value!="")
		{
			document.getElementById("password").type="text";
			document.getElementById("show").style.display="none";
			document.getElementById("hide").style.display="block";
		}
	}

	function HidePassword()
	{
		if(document.getElementById("password").type == "text")
		{
			document.getElementById("password").type="password"
			document.getElementById("show").style.display="block";
			document.getElementById("hide").style.display="none";
		}
	}

	function ShowPassword2()
	{
		if(document.getElementById("password1").value!="")
		{
			document.getElementById("password1").type="text";
			document.getElementById("show2").style.display="none";
			document.getElementById("hide2").style.display="block";
		}
	}

	function HidePassword2()
	{
		if(document.getElementById("password1").type == "text")
		{
			document.getElementById("password1").type="password"
			document.getElementById("show2").style.display="block";
			document.getElementById("hide2").style.display="none";
			$('#hide2').attr('style','display:none;');
		}
	}

	
	</script>
</body>
</html>
