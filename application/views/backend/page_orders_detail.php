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
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {
    opacity: 0.7;
}


/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.9);
    /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content,
#caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {
        -webkit-transform: scale(0)
    }

    to {
        -webkit-transform: scale(1)
    }
}

@keyframes zoom {
    from {
        transform: scale(0)
    }

    to {
        transform: scale(1)
    }
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
    .modal-content {
        width: 100%;
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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> แก้ไข ออเดอร์</h4>
                                <hr>
                                <h4 style="color: #011242;">สถานะการจัดส่งปัจจุบัน : 
                                <span class="badge badge-info" ><?=$status[$ORDER_DETAIL_RESULT[0]->Order_status];?></span> 
                                <span class="badge badge-danger" ><?php if(!$Billing_Checker){ echo 'ยังไม่ได้อัพโหลดสลิป'; }else{ echo 'อัพโหลดสลิปแล้ว'; } ?></span> 
                                </h4>
                                <hr>
                                <form
                                    onSubmit='post_ajax("<?= base_url('Backend/manager/order_update'); ?>",$(this).serialize());return false;'
                                    method="post">
                                    <input type="hidden" name="order_id" value="<?=$ORDER_DETAIL_RESULT[0]->OrderID;?>">
                                    <p>
                                        <span style="color: #011242;">สถานะ: <select class="form-control" name="status_order">
                                            <option value="not">---------กรุณาเลือกสถานะ----------</option>
                                            <?php foreach($status as $key => $val){
                                                echo '<option value="'.$key.'">'.$val.'</option>';
                                            } ?>
                                            
                                        </select></span>
                                    </p>
                                    <?php if($Billing_Checker){ 
                                        $Billings = $this->db->where('Topup_order',$ORDER_DETAIL_RESULT[0]->OrderID)->get('tbl_paynment')->result();
                                        echo '<button type="button" onclick="img_zoom(\''.base_url('assets/images/Payment/'.$Billings[0]->Topup_img).'\')" class="btn btn-info">ดูสลิปการโอนเงิน</button>'; } ?>
                                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                    <button onclick="deletes('<?=base_url('Backend/delete/orders_delete');?>',<?=$ORDER_DETAIL_RESULT[0]->OrderID;?>)" type="button" class="btn btn-danger">ลบข้อมูล</button>
                                </form>
                                <hr>
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
                                        $total = 0;
                                        $i = 0;
                                        foreach($ORDER_SQL->result() as $ORDERS){
                                            $i++;
                                            $total = $total + $ORDERS->Orders_Price;
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
                                            <td colspan="2">'.number_format($total,2).'</td>
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
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
<script>
function img_zoom(url) {
    $('#myModal').css("display", "block");
    $('#img01').attr("src", url);
    $('#caption').html(this.alt);
}

$(".close").on("click", function() {
    $('#myModal').css("display", "none");
});
$(document).on('keyup', function(e) {
    if (e.key == "Escape") $('#myModal').css("display", "none");;
});
</script>
<?php $this->load->view('Template/frontend/footer'); ?>
