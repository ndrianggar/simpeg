<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a id="logo_site" href="<?=base_url()?>" class="site_title">
				<img src="<?=base_url()?>assets/images/logo2.gif" width="45px" height="45px">
				<span> Simpeg Polines</span>
			</a>
		</div>
		<div class="clearfix"></div>

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<ul class="nav side-menu">
				<?php 
				$main_menu 	= $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE is_main_menu='X' AND status_menu<>'1'
							  AND akses_menu LIKE '%Admin%' 
							  ORDER BY kd_menu;");
				foreach ($main_menu->result() as $menu) {
					$sub_menu 	= $this->db->query(
								  "SELECT * FROM menu_sidebar 
								  WHERE is_main_menu='$menu->kd_menu' AND status_menu<>'1' 
								  AND akses_menu LIKE '%Admin%' 
								  ORDER BY kd_menu");
					if ($sub_menu->num_rows()>0){
						//main_menu dengan sub_menu
						echo 	'<li>
									<a>
										<i class="' 	. $menu->icon_menu 	. 
										'"></i>' 		. $menu->judul_menu . 
										'<span class="fa fa-chevron-down"></span>
									</a>
									<ul class="nav child_menu">';
						foreach ($sub_menu->result() as $submenu) {
							echo 	'<li>
										<a href="' 		. base_url() 		. $submenu->link_menu 	. 
								 		'">' 			. $submenu->judul_menu . 
								 	'</a></li>';
						}		
						echo '</ul></li>';
					} else {
						//main_menu tanpa sub_menu atau tunggal
						echo 	'<li>
									<a href="' 			. base_url() 		. $menu->link_menu 		. 
										'"><i class="' 	. $menu->icon_menu 	. 
										'"></i>' 		. $menu->judul_menu . 
									'</a>
								</li>';
					}
				}
				?>
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->

	</div>
</div>