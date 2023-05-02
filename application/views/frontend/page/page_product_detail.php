<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<style>
/* Shine */
figure {
    width: 100%;
    margin: 0;
    padding: 0;
    background: #fff;
    overflow: hidden;
}

figure:hover+span {
    bottom: -36px;
    opacity: 1;
}

.hover14 figure {
    position: relative;
}

.hover14 figure::before {
    position: absolute;
    top: 0;
    left: -75%;
    z-index: 2;
    display: block;
    content: '';
    width: 50%;
    height: 100%;
    background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .3) 100%);
    background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .3) 100%);
    -webkit-transform: skewX(-25deg);
    transform: skewX(-25deg);
}

.hover14 figure:hover::before {
    -webkit-animation: shine .75s;
    animation: shine .75s;
}

@-webkit-keyframes shine {
    100% {
        left: 125%;
    }
}

@keyframes shine {
    100% {
        left: 125%;
    }
}


#codebox {
    padding: 15px;
    font-family: Courier, sans-serif;
    font-size: 1em;
    line-height: 1.3;
    color: #fff;
    background-color: #2c3e50;
    -webkit-border-radius: 0px 0px 6px 6px;
    -moz-border-radius: 0px 0px 6px 6px;
    border-radius: 0px 0px 6px 6px;
    margin-bottom: 10px;
}

code {
    font-family: Courier, sans-serif;
    font-size: 1em;
    line-height: 1.3;
}

.codeheader {
    padding: 5px 5px 5px 10px;
    font-family: 'Roboto', sans-serif;
    font-size: 1.1em;
    color: #fff;
    -webkit-border-radius: 6px 6px 0px 0px;
    -moz-border-radius: 6px 6px 0px 0px;
    border-radius: 6px 6px 0px 0px;
    user-select: none;
    -ms-user-select: none;
    /* IE10+, Edge */
    -moz-user-select: none;
    /* Mozilla */
    -webkit-user-select: none;
    /* Safari */
}

#codeheader_html {
    background-color: #3D9970;
}

#codeheader_css {
    background-color: #e67e22;
}

#codeheader_php {
    background-color: #85144b;
}

#codeheader_js {
    background-color: #0074D9;
}
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
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> รายละเอียดสินค้า</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" width="560" height="315"
												src="https://www.youtube.com/embed/<?=$PRODUCT_RESULT[0]->Product_youtube;?>"
                                                //src="https://www.youtube.com/embed/6nuGcivLGlc"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="col-sm-7" style="color: #011242;">
                                        <p>
                                        <h1>ชื่อสินค้า: <?=$PRODUCT_RESULT[0]->Product_name;?></h1>
                                        </p>
                                        <p><span>คำอธิบาย: <?=$PRODUCT_RESULT[0]->Product_description;?><span></p>
                                        <p><span>ราคาต่อชิ้น:
                                                <?=number_format($PRODUCT_RESULT[0]->Product_price,2);?><span></p>
                                        <p><span>เหลือในสต๊อก: <?=$PRODUCT_RESULT[0]->Product_stocker;?><span></p>
                                        <hr>
                                        <p>
                                            <button
                                                onclick="basket('<?=base_url('product/cart_process');?>',<?=$PRODUCT_RESULT[0]->Product_id;?>,'add',0)"
                                                type="button"
                                                class="btn btn-primary btn-lg btn-block">นำสินค้าใส่ตะกร้า</button>
                                            <button type="button"
                                                class="btn btn-danger btn-lg btn-block">กลับไปหน้าเลือกสินค้า</button>
                                        </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                        <div class="codeheader" id="codeheader_js">รายละเอียด</div>
                                        <div id="codebox"><?=$PRODUCT_RESULT[0]->Product_detail;?></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block" style="color: #6c7293;">Copyright ©
						sarawut.ms 5168</span>

                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?php $this->load->view('Template/frontend/footer'); ?>
