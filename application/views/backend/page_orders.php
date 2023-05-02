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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> เลข Order ทั้งหมด</h4>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">หมายเลขออเดอร์</th>
                                            <th scope="col">ชื่อผู้สั่ง</th>
                                            <th scope="col">วันเวลา</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $status = array('รอชำระเงิน','รออนุมัติ','กำลังจัดส่ง');
                                        foreach($ORDER_DETAIL_RESULT as $ORDER_DETAIL){
                                            echo '
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>'.$ORDER_DETAIL->Order_Number.'</td>
                                                    <td>'.$ORDER_DETAIL->Order_FullName.'</td>
                                                    <td>'.$ORDER_DETAIL->Order_Dttm.'</td>
                                                    <td><span class="badge badge-pill badge-primary">'.$status[$ORDER_DETAIL->Order_status].'</span></td>
                                                    <td>
                                                        <a href="'.base_url('Backend/manager/orders_detail/'.$ORDER_DETAIL->OrderID).'" class="btn btn-sm btn-warning"><i class="mdi mdi-eye"></i> จัดการ</a>
														<button onclick="deletes(\''.base_url('Backend/delete/orders_delete').'\','.$ORDER_DETAIL->OrderID.')" type="button" class="btn btn-danger">ลบข้อมูล</button>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- <a href="'.base_url('product/order/detail/'.$ORDER_DETAIL->OrderID).'" class="btn btn-sm btn-danger">ลบข้อมูล</a> -->



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
