<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<link href="<?=base_url('assets/css/firework.css');?>">
<style>
.img {
    width: 100%;
    filter: grayscale(100%);
    -webkit-filter: grayscale(100%);
    top: -160px;
    z-index: 2;
}

.img:hover {
    filter: none;
    transition: 1s;
    -webkit-filter: grayscale(0);
}

div.parent {
    left: 0;
    bottom: 0;
    width: 180%;
    color: white;
    text-align: center;
    z-index: 3;
}

.content-wrapper {
    background-image: url("assets/images/bggift.jpg");
    /* Full height */
    height: 100%;
/* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    
	/*background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
	background: #182d67;
	background: linear-gradient(90deg, #182d67, #e73c7e, #23a6d5, #FFC000, #23d5ab);
    
	background-size: 400% 400%;
	animation: gradient 3s ease infinite;
	height: 100vh;*/

}

/*@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}*/

</style>
<div class="container-scroller">
    <?php $this->load->view('Template/frontend/slidbar'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <?php $this->load->view('Template/frontend/nav'); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
            <div class="pyro">
                    <div class="before"></div>
                    <div class="after"></div>
                </div>
                <!--<div class="row">
                    <div class="col-3" style="padding:0px; margin:0px;">
                    <img width="150%"src="<?=base_url('assets/images/pngwing.png');?>">
                    </div>
                    <div class="col-6">
                        <center><img src="<?=base_url('assets/images/shop-logo.png');?>"
                                class="animate__heartBeat animate__animated animate__infinite" style="width: 70%">
                        </center>
					<div class="col-sm-6 border" style="position:relative">-->
                        <div class="row">
                            <div class="col-sm-6 " style="position:relative">
                                <a href="<?=base_url('/Online');?>"><img src="<?=base_url('assets/images/dashboard/giftbox.png');?>" class="img"> </a>
								<h1 style="font-size:2vw;"><div class="text-center mb-4"  style="position:absolute; bottom:5%; width:100%">สร้างของขวัญ</div></h1>
                            </div>
                            <div class="col-sm-6 " style="position:relative">
                                <a href="<?=base_url('/product/category/1');?>"><img src="<?=base_url('assets/images/dashboard/giftbox.png');?>" class="img"> </a>
								<h1 style="font-size:2vw;"><div class="text-center mb-4"  style="position:absolute; bottom:5%; width:100%">ซื้อของขวัญ</div></h1>
                            </div>
                        </div>
                    </div>
            
					<!--<div class="col-3" style="padding:0px; margin:0px;">
                    <img width="70%" style="margin-top:30%;" src="<?=base_url('assets/images/pngwing2.png');?>">
                    </div>-->
                </div>
            </div>
            
        </div>

        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    
</div>
<?php $this->load->view('Template/frontend/footer'); ?>
