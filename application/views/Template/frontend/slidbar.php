<!-- partial:partials/_sidebar.html -->
<?php 
		if(!empty($this->session->userdata('login-state'))){
			$this->db->where('Email',$this->session->userdata('email'));
			$User_query = $this->db->get("tbl_users");
			$User_result = $User_query->result();
		}
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" style="text-decoration: none; color: #011242;" href="<?=base_url('');?>">Gift-for-you</a>
        <a class="sidebar-brand brand-logo-mini" href="<?=base_url('');?>"> </a>
    </div>
    <ul class="nav">
        <?php if($this->session->userdata('login-state')): ?>
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle "
                            src="<?=base_url('assets/images/faces/'.$User_result[0]->Avatar);?>" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name" style="color: #011242;">
                        <h5 class="mb-0 font-weight-normal"><?=$User_result[0]->FullName;?></h5>
                        <span><?=$User_result[0]->Role;?></span>
                    </div>
                </div>
                <a id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="<?=base_url('Profile/account');?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
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
                            <p class="preview-subject ellipsis mb-1 text-small">Log out</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <?php endif; ?>
        <li class="nav-item nav-category">
            <span class="nav-link">Main Menu</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url();?>">
                <span class="menu-icon">
                    <i class="mdi mdi-home"></i>
                </span>
                <span class="menu-title">หน้าแรก</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-store"></i>
                </span>
                <span class="menu-title">ร้านค้า</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <?php 
                        $CATEGORY_QUERY = $this->db->get('tbl_category');
                        foreach($CATEGORY_QUERY->result() as $CATEGORY){
                            echo '<li class="nav-item"> <a class="nav-link" href="'.base_url('product/category/'.$CATEGORY->CategoryID).'">'.$CATEGORY->CategiryName.'</a></li>';
                        }
                    ?>

                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Online');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-wallet-giftcard"></i>
                </span>
                <span class="menu-title">ของขวัญแบบออนไลน์</span>
            </a>
        </li>   
        <?php if($this->session->userdata('login-state')): ?>
		<li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Online/mygift');?>">
                <span class="menu-icon">
					<i class="mdi mdi-gift"></i>
                </span>
                <span class="menu-title">ของขวัญของฉัน</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Profile/myorder');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">ออเดอร์ของฉัน</span>
            </a>
        </li>
        <?php if($User_result[0]->Role == 'superadmin'): ?>
        <li class="nav-item nav-category">
            <span class="nav-link">Administrator</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Backend/manager/product');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-store"></i>
                </span>
                <span class="menu-title">จัดการสินค้า</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Backend/manager/category');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">จัดการหมวดหมู่สินค้า</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Backend/manager/orders');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">ออเดอร์ลูกค้า</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?=base_url('Backend/manager/online');?>">
                <span class="menu-icon">
                    <i class="mdi mdi-paper-cut-vertical"></i>
                </span>
                <span class="menu-title">จัดการของขวัญออนไลน์</span>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>

    </ul>
</nav>
