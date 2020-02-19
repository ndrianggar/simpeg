<!-- top navigation -->
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="<?=$this->session->userdata('foto_pegawai_siskap')?>">
						<?=$this->session->userdata('nama_pegawai_siskap')?>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="<?=base_url().'pegawai/detail/'. $this->session->userdata('kode_pegawai_siskap')?>">Profile</a></li>
						<li><a href="<?=base_url()?>setting"> Setting</a></li>
						<li><a href="<?=base_url()?>user/logout"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
					</ul>
					<input id="akses_pegawai" type="hidden" value="<?=$this->session->userdata('akses_pegawai_siskap')?>">
				</li>
				<li role="presentation" class="dropdown">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span id="total_notice" class="badge bg-green" style="display: none;"></span>
					</a>
					<ul class="dropdown-menu list-unstyled msg_list" role="menu">
						<li id="menu_notice"></li>
						<li >
							<div class="text-center">
								<a href="<?=base_url()?>notice/lihat_semua/">
									<strong id="lihat_semua">-- Lihat Semua --</strong>
								</a>
							</div>
						</li>
					</ul>
				</li>
				<li role="presentation" class="dropdown">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user"></i>
						<span id="user_online" class="badge bg-green" style="display: none;">0</span>
					</a>
					<ul id="menu_user" class="dropdown-menu list-unstyled msg_list" role="menu">
					</ul>
				</li>
				<li role="presentation" class="dropdown" style="display: none;">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope"></i>
						<span class="badge bg-green">6</span>
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!-- /top navigation -->