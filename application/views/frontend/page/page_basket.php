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
                        <div class="card" id="order_step1">
                            <div class="card-body">
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> ระบบตะกร้าสินค้า</h4>
                                <hr>

                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-12">
                                        <div class="card card-registration card-registration-2"
                                            style="border-radius: 15px;">
                                            <div class="card-body p-0">
                                                <div class="row g-0">
                                                    <div class="col-lg-8">
                                                        <div class="p-5">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-5">
                                                                <h1 class="fw-bold mb-0" style="color: #011242;">Shopping Cart</h1>
                                                                <!-- <h6 class="mb-0 ">3 items</h6> -->
                                                            </div>
                                                            <hr class="my-4 ">
                                                            <?php 
                                                                            $TOTAL_PRICE=0;
                                                                            $TOTAL_QTY=0;
                                                                            if(empty($_SESSION['CART'])){
                                                                                echo '<center style="color: #011242;">คุณยังไม่ได้เลือกสินค้าเข้าตะกร้า</center>';
                                                                            }else{
                                                                                foreach(@$_SESSION['CART'] as $ProductID => $QTY)
                                                                                {
                                                                                    $this->db->where('Product_id',$ProductID);
                                                                                    $ProductSQL = $this->db->get('tbl_product');
                                                                                    $peoductResult = $ProductSQL->result();
                                                                                    $SUM_PRICE	= $peoductResult[0]->Product_price * $QTY;
                                                                                    $TOTAL_PRICE	+= $SUM_PRICE;
                                                                                    $TOTAL_QTY	+= $QTY;
                                                                                    echo 
                                                                                    '
                                                                                        <div id="product_'.$peoductResult[0]->Product_id.'" class="row mb-4 d-flex justify-content-between align-items-center">
                                                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                            <img src="'.base_url('assets/images/product/'.$peoductResult[0]->Product_img).'" class="img-fluid rounded-3" alt="'.$peoductResult[0]->Product_name.'">
                                                                                        </div>
                                                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                                                            <h6 class="mb-0" style="color: #011242;">'.$peoductResult[0]->Product_name.'
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-4 col-xl-3 d-flex">
                                                                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown();basket(\''.base_url('product/cart_process').'\','.$peoductResult[0]->Product_id.',\'update\',$(\'#amount_'.$peoductResult[0]->Product_id.'\').val());$(\'#sum_price_'.$peoductResult[0]->Product_id.'\').html(formatter.format('.$peoductResult[0]->Product_price.' * $(\'#amount_'.$peoductResult[0]->Product_id.'\').val()) + \'.00\');update_total(\''.base_url('product/get_total_price').'\');">
                                                                                                <i class="fas fa-minus"></i>
                                                                                            </button>

                                                                                            <input onchange="basket(\''.base_url('product/cart_process').'\','.$peoductResult[0]->Product_id.',\'update\',$(\'#amount_'.$peoductResult[0]->Product_id.'\').val());$(\'#sum_price_'.$peoductResult[0]->Product_id.'\').html(formatter.format('.$peoductResult[0]->Product_price.' * $(\'#amount_'.$peoductResult[0]->Product_id.'\').val()) + \'.00\');update_total(\''.base_url('product/get_total_price').'\');" id="amount_'.$peoductResult[0]->Product_id.'" min="0" name="quantity"
                                                                                                value="'.$QTY.'" type="number"
                                                                                                class="form-control" />

                                                                                            <button class="btn btn-link" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp();basket(\''.base_url('product/cart_process').'\','.$peoductResult[0]->Product_id.',\'update\',$(\'#amount_'.$peoductResult[0]->Product_id.'\').val());$(\'#sum_price_'.$peoductResult[0]->Product_id.'\').html(formatter.format('.$peoductResult[0]->Product_price.' * $(\'#amount_'.$peoductResult[0]->Product_id.'\').val()) + \'.00\');update_total(\''.base_url('product/get_total_price').'\');">
                                                                                                <i class="fas fa-plus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                                            <h6 class="mb-0" id="sum_price_'.$peoductResult[0]->Product_id.'" style="color: #011242;">'.number_format($SUM_PRICE,2).'</h6>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                                                            <a href="javascript:void(0)" onclick="basket(\''.base_url('product/cart_process').'\','.$peoductResult[0]->Product_id.',\'remove\',0);$(\'#product_'.$peoductResult[0]->Product_id.'\').remove();update_total(\''.base_url('product/get_total_price').'\');" class=""><i
                                                                                                    class="fas fa-times"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr class="my-4">
                                                                                    ';
                                                                                }
                                                                            }
                                                                        ?>

                                                            <hr class="my-4">

                                                            <!--<div class="pt-5">
                                                                <h6 class="mb-0" ><a href="#!" class="text-body">
                                                                    <i class="fas fa-long-arrow-alt-left me-2" style="color: #011242;"></i>กลับไปหน้าสินค้า</h6></a>
                                                                </h6>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 bg-grey">
                                                        <div class="p-5">
                                                            <h3 class="fw-bold mb-5 mt-2 pt-1" style="color: #011242;">สรุปยอด</h3>
                                                            <hr class="my-4">

                                                            <div class="d-flex justify-content-between mb-4">
                                                                <h5 id="TOTAL_QTY" class="text-uppercase" style="color: #011242;">จำนวนสินค้า:
                                                                    <?=$TOTAL_QTY;?></h5>
                                                                <h5 id="total_price_cart" style="color: #011242;">
                                                                    <?=number_format($TOTAL_PRICE,2);?></h5>
                                                            </div>

                                                            <h5 class="text-uppercase mb-3" style="color: #011242;">การขนส่งสินค้า</h5>

                                                            <div class="mb-4 pb-2">
                                                                <select style="color: Gray;"  style="background-color: #2a3222;"
                                                                    class="form-control text-white">
                                                                    <option value="1">ติดต่อทางไลน์</option>
                                                                </select>
                                                            </div>

                                                            <hr class="my-4">

                                                            <div class="d-flex justify-content-between mb-5">
                                                                <h5 class="text-uppercase" style="color: #011242;">ยอดรวมทั้งหมด</h5>
                                                                <h5 id="total_price_cart2" style="color: #011242;">
                                                                    <?=number_format($TOTAL_PRICE,2);?></h5>
                                                            </div>

                                                            <button id="btn_step" type="button" class="btn btn-dark btn-block btn-lg">ดำเนินการต่อ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card" id="order_step2" style="display:none;">
                            <div class="card-body">
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> กรอกข้อมูลลูกค้าเบื้องต้น</h4>
                                <hr>

                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-12">
                                        <div class="card card-registration card-registration-2"
                                            style="border-radius: 15px;">
                                            <div class="card-body p-0">
                                                <div class="row g-0">
                                                    <div class="col-lg-8">
                                                        <div class="p-5">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-5">
                                                                <h1 class="fw-bold mb-0" style="color: #011242;">ข้อมูลที่อยู่ลูกค้า</h1>
                                                                <!-- <h6 class="mb-0 ">3 items</h6> -->
                                                            </div>
                                                            <hr class="my-4">
                                                            <form onSubmit='post_ajax("<?= base_url('product/cart_process_two'); ?>",$(this).serialize());return false;' method="post">
                                                                <div class="form-group" style="color: #011242;">
                                                                    <label>ชื่อ นามสกุล</label>
                                                                    <input type="text" name="FullName"
                                                                        class="form-control p_input">
                                                                </div>
                                                                <div class="form-group" style="color: #011242;">
                                                                    <label>เบอร์โทรศัพท์</label>
                                                                    <input type="text" name="Telephone"
                                                                        class="form-control p_input">
                                                                </div>
                                                                <div class="form-group" style="color: #011242;">
                                                                    <label>อีเมล์</label>
                                                                    <input type="email" name="Email"
                                                                        class="form-control p_input">
                                                                </div>
                                                                <input type="hidden" value="<?=$TOTAL_QTY;?>" name="QTY_TOTAL" class="form-control p_input">
                                                                <input type="hidden" value="<?=$TOTAL_PRICE;?>" name="PRICE_TOTAL" class="form-control p_input">
                                                                <div class="form-group" style="color: #011242;">
                                                                    <label>ที่อยู่</label>
                                                                    <textarea name="Address" rows="4" class="form-control"></textarea>
                                                                </div>
                                                                <p class="sign-up" style="color: red;">** กรุณาตรวจสอบข้อมูลของคุณให้ถูกต้องเพื่อความสะดวกต่อการดำเนินการ **</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 bg-grey">
                                                        <div class="p-5">
                                                            <h3 class="fw-bold mb-5 mt-2 pt-1" style="color: #011242;">สรุปยอด</h3>
                                                            <hr class="my-4">

                                                            <div class="d-flex justify-content-between mb-4">
                                                                <h5 id="TOTAL_QTY" class="text-uppercase" style="color: #011242;">จำนวนสินค้า:
                                                                    <?=$TOTAL_QTY;?></h5>
                                                                <h5 id="total_price_cart" style="color: #011242;">
                                                                    <?=number_format($TOTAL_PRICE,2);?></h5>
                                                            </div>

                                                            <h5 class="text-uppercase mb-3" style="color: #011242;">การขนส่งสินค้า</h5>

                                                            <div class="mb-4 pb-2">
                                                                <select style="color: white;" disabled style="background-color: #2a3038;"
                                                                    class="form-control text-white">
                                                                    <option value="1">ติดต่อทางไลน์</option>
                                                                </select>
                                                            </div>

                                                            <hr class="my-4">

                                                            <div class="d-flex justify-content-between mb-5">
                                                                <h5 class="text-uppercase" style="color: #011242;">ยอดรวมทั้งหมด</h5>
                                                                <h5 id="total_price_cart2" style="color: #011242;">
                                                                    <?=number_format($TOTAL_PRICE,2);?></h5>
                                                            </div>

                                                            <button  type="submit" class="btn btn-dark btn-block btn-lg">ดำเนินการต่อ</button>
                                                            <button id="btn_step2" type="button" class="btn btn-primary btn-block btn-sm">กลับไปดูหน้าสินค้า</button>
                                                                
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                    <span class=" d-block text-center text-sm-left d-sm-inline-block" style="color: #6c7293;">Copyright &copy;
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
