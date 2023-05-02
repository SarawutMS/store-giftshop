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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi mdi-store"></i> เพิ่มสินค้า</h4>
                                <hr>
                                <form enctype="multipart/form-data" method="post" action="<?=base_url('Backend/save/product_add');?>">
                                    <!--<div class="row">
                                         <div class="col-sm-5">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" width="560" height="315"
                                                    src="https://www.youtube.com/embed/6nuGcivLGlc"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>

                                            </div> 
                                            <p>
                                                <center>
                                                    <div class="btn-group btn-group-lg" role="group"
                                                        aria-label="Basic example">
                                                        <button type="submit" class="btn btn-success btn-md">บันทึกข้อมูล</button>
                                                    </div>
                                                </center>
                                            </p>
                                        </div>-->

                                        <center><div class="col-sm-7">
                                            <p class="text-left">
                                                <span>ชื่อสินค้า: <input class="form-control" required name="name_product" type="text"></span>
                                            </p>
                                            <p class="text-left"><span>คำอธิบาย: <input class="form-control" required name="description" type="text"><span></p>

                                            <p class="text-left"><span>ราคาต่อชิ้น: <input class="form-control" required name="price" type="text"><span></p>
                                            <p class="text-left"><span>เหลือในสต๊อก: <input class="form-control" required name="stocker" type="text" ><span></p>
                                            <p class="text-left"><span>ลิงค์ยูทูป (นำตัวอักษรหลัง ?v= มาใส่): <input required class="form-control" name="youtube" type="text"><span></p>
                                            <p class="text-left"><span>รูปภาพสินค้า: <input required class="form-control" name="product_img" type="file" ><span></p>
                                            <p class="text-left"><span>ประเภทสินค้า: <select style="color: #011242;" name="category" class="form-control">
                                                <?php 
                                                $CATEGORY_SQL = $this->db->get('tbl_category');
                                                foreach($CATEGORY_SQL->result() as $CATEGORY){
                                                    echo '<option value="'.$CATEGORY->CategoryID.'">'.$CATEGORY->CategiryName.'</option>';
                                                }
                                                ?>
                                                
                                            </select><span></p>
                                            <hr>
                                        </div></center>
                                        <p>
                                                <center>
                                                    <div class="btn-group btn-group-lg" role="group"
                                                        aria-label="Basic example">
                                                        <button type="submit" class="btn btn-success btn-md">บันทึกข้อมูล</button>
                                                    </div>
                                                </center>
                                            </p>
                                        </div>

                                        <div class="col-sm-12">
                                            <hr>
                                            <h3>รายละเอียด</h3>
                                            <textarea name="detail"
                                                class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('detail');
                                            </script>
                                        </div>
                                    </div>
                                </form>
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
