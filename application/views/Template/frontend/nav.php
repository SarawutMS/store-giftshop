<?php 
		if(!empty($this->session->userdata('login-state'))){
			$this->db->where('Email',$this->session->userdata('email'));
			$User_query = $this->db->get("tbl_users");
			$User_result = $User_query->result();
		}
?>
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="<?=base_url('');?>" style="color: #011242;">
            Gift-for-you
        </a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
            <li class="nav-item dropdown "> <!--border-left border-right-->
                <a class="nav-link" href="<?=base_url('product/cart');?>"><i class="fa fa-shopping-cart" style="color: #011242;
                        aria-hidden="true"></i></a>
            </li>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <?php if(!$this->session->userdata('login-state')): ?>
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown"
                    aria-expanded="false" href="#">ระบบสมาชิก</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="createbuttonDropdown">
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url('sign-in');?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-file-outline text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1">เข้าสู่ระบบ</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url('sign-up');?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-web text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1">สมัครสมาชิก</p>
                        </div>
                    </a>
                </div>
            </li>
            <?php endif; ?>
            <?php if($this->session->userdata('login-state')): ?>
            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile" style="color: #011242;">
                        <img class="img-xs rounded-circle"
                            src="<?=base_url('assets/images/faces/'.$User_result[0]->Avatar);?>" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name"><?=$User_result[0]->FullName;?></p>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">Profile</h6>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url('Profile/account');?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url('auth/sign-out');?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Log out</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
            </li>
            <?php endif;  ?>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>
