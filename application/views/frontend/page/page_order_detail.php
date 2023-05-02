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
    <?php $this->load->view('Template/frontend/slidbar'); $status = array('รอชำระเงิน','รออนุมัติ','กำลังจัดส่ง'); ?>
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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> เลข Order ที่สั่งไว้ทั้งหมด</h4>
                                <hr>
                                <div class="alert alert-dark" role="alert">
                                    <h4 class="alert-heading">ขั้นตอนการชำระเงิน</h4>
                                    <!--<b>** ขั้นตอนต่อไปในการสั่งออเดอร์ให้ติดต่อ <a target="_blank" href="https://lin.ee" class="alert-link"
                                            style="color: green;">Line</a> มาหาแอดมินและแจ้งหมายเลขออเดอร์ด้วยนะคะ
                                        เพื่อตรวจสอบและทำขั้นตอนชำระเงินค่ะ**<b>-->
                                </div>
                                <hr>
                                <h4 style="color: #011242;">สถานะการจัดส่ง : <span class="badge badge-info">
                                    <?=$status[$ORDER_DETAIL_RESULT[0]->Order_status];?>
                                </span>
                                <?php 
                                        if($ORDER_DETAIL_RESULT[0]->Order_status == 0){ 
                                            echo '<a href="'.base_url('topup/'.$ORDER_DETAIL_RESULT[0]->OrderID).'" class="btn btn-md btn-warning"><i class="fa-solid fa-building-columns"></i> ชำระเงินเดี๋ยวนี้</a>'; 
                                        }
                                    ?>
                                </h4><hr>
                                <p style="color: #011242;">ชื่อจริง: <b><?=$ORDER_DETAIL_RESULT[0]->Order_FullName;?></b></p>
                                <p style="color: #011242;">อีเมล์: <b><?=$ORDER_DETAIL_RESULT[0]->Order_Email;?></b></p>
                                <p style="color: #011242;">เบอร์ติดต่อ: <b><?=$ORDER_DETAIL_RESULT[0]->Order_Telephone;?></b></p>
                                <p style="color: #011242;">ที่อยู่: <b><?=$ORDER_DETAIL_RESULT[0]->Order_Address;?></b></p>
                                <hr>
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> สินค้าใน Order นี้</h4>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">รูปสินค้า</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">จำนวนที่สั่ง</th>
                                            <th scope="col">ราคา/หน่วย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $this->db->where('Orders_Number',$ORDER_DETAIL_RESULT[0]->Order_Number);
                                        $ORDER_SQL = $this->db->get('tbl_orders');
                                        $i = 0;
                                        foreach($ORDER_SQL->result() as $ORDERS){
                                            $i++;
                                            $this->db->where('Product_id',$ORDERS->Orders_Product);
                                            $PRODUCT_SQL = $this->db->get('tbl_product');
                                            $PRODUCT = $PRODUCT_SQL->result();

                                            echo '
                                                <tr>
                                                    <th scope="row">'.$i.'</th>
                                                    <td><img src="'.base_url('assets/images/product/'.$PRODUCT[0]->Product_img).'"></td>
                                                    <td>'.$PRODUCT[0]->Product_name.'</td>
                                                    <td>'.$ORDERS->Orders_Qty.'</td>
                                                    <td>'.number_format($ORDERS->Orders_Price,2).'</td>
                                                </tr>
                                            ';
                                        }
                                        echo 
                                        '<tr>
                                            <td colspan="3"></td>
                                            <td>ราคารวม: </td>
                                            <td colspan="2">'.number_format($ORDER_DETAIL_RESULT[0]->Order_PriceTotal,2).'</td>
                                        </tr>';
                                        ?>
                                    </tbody>
                                </table>


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
