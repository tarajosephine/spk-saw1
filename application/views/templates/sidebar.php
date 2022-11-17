<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->
        <a href="<?= base_url('user'); ?>" class="logo text-center logo-light mt-2">
            <span class="logo-lg">
                <img src="<?= base_url(); ?>assets/images/sayaka.jpeg" alt="" height="80">
            </span>
            <span class="logo-sm">
                <img src="<?= base_url(); ?>assets/images/sayaka.jpeg" alt="" height="50">
            </span>
        </a>

        <!-- LOGO -->
        <a href="<?= base_url('user'); ?>" class="logo text-center logo-dark mt-2">
            <span class="logo-lg">
                <img src="<?= base_url(); ?>assets/images/sayaka.jpeg" alt="" height="70">
            </span>
            <span class="logo-sm">
                <img src="<?= base_url(); ?>assets/images/sayaka.jpeg" alt="" height="50">
            </span>
        </a>

        <div class="h-100 mt-3" id="leftside-menu-container" data-simplebar="">

            <!--- Sidemenu -->
            <ul class="side-nav">
                <!-- Query Menu -->
                <?php
				$role_id = $this->session->userdata('role_id');
				$queryMenu = "SELECT `user_menu`.`id`, `menu`
						FROM `user_menu` JOIN `user_access_menu`
						ON `user_menu`.`id` = `user_access_menu`.`menu_id`
						WHERE `user_access_menu`.`role_id` = $role_id
						ORDER BY `user_access_menu`.`menu_id` ASC
						";
				$menu = $this->db->query($queryMenu)->result_array();
				?>

                <!-- Looping Menu -->
                <?php foreach ($menu as $m) : ?>
                <li class="side-nav-title side-nav-item"><?= $m['menu']; ?></li>

                <!-- Sub-Menu sesuai Menu -->
                <?php
					// $menuId = $m['id'];
					$querySubMenu = "SELECT *
				FROM `user_sub_menu` JOIN `user_menu`
				ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
				WHERE `user_sub_menu`.`menu_id` = {$m['id']}
				AND `user_sub_menu`.`is_active` = 1
			";
					$subMenu = $this->db->query($querySubMenu)->result_array();
					?>

                <?php foreach ($subMenu as $sm) : ?>
                <!-- Nav Item - Dashboard -->
                <li class="side-nav-item">
                    <a class="side-nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span></a>
                </li>
                <?php endforeach; ?>
                <!-- Divider -->
                <hr class="sidebar-divider mt-3">
                <?php endforeach; ?>

                <li class="side-nav-item">
                    <a class="side-nav-link pb-0" href="<?= base_url(); ?>auth/logout" data-toggle="modal"
                        data-target="#logoutModal">
                        <i class="mdi mdi-logout"></i>
                        <span>Logout</span></a>
                </li>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
