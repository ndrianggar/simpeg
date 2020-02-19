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
									<a href="<?=base_url()?>reset">
										Data User Manage
									</a>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<table id="tabel-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>NIP</th>
											<th>Nama Pegawai</th>
											<th>E-mail</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
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
														<input id="id" name="id" type="hidden">
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
			var tabel = $('#tabel-data').dataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>reset/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nip"},
									{ "mData"	: "nama"},
									{ "mData"	: "email"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,4] },
									{ width: 30, targets: 0},
									{ width: 30, targets: 4}
								],
				"fixedColumns": true
			});

			$('#tabel-body').on('click', '#btn-reset', function(){
				save_method = 'pass';
				$('#form1')[0].reset();
				$('#id').val($(this).data('id'));
				$('.form-group').removeClass('has-error').removeClass('has-success');
				$('.text-danger').remove();
				$('#modalChangePass').modal('show');
			});

			// $('#tambah-simpan').click(function() {
			// 	$('#form-tambah').ajaxForm({
			// 		success: 	function(msg){
			// 			if(msg=='true'){
			// 				tabel.api().ajax.reload();
			// 				swal($('.modal-title').html() + ' Sukses');
			// 				$('#form-tambah')[0].reset();
			// 				$('#modal-tambah').modal('hide');
			// 			}else{
			// 				tabel.api().ajax.reload();
			// 				swal($('.modal-title').html() + ' Gagal');
			// 				$('#form-tambah')[0].reset();
			// 				$('#modal-tambah').modal('hide');
			// 			}
			// 		},
			// 		error: function(){
			// 			swal('ERROR : function(response)');
			// 		}
			// 	}).submit();
			// });
		});

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
		}
	}

	</script>
</body>
</html>
