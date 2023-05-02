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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> แก้ไขสินค้า</h4>
                                <hr>
                                <form enctype="multipart/form-data" method="post" action="<?=base_url('Backend/save/product_edit');?>">
                                    <input class="form-control" name="Product_id" type="hidden"
                                        value="<?=$PRODUCT_RESULT[0]->Product_id;?>">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" width="560" height="315"
                                                    src="https://www.youtube.com/embed/<?=$PRODUCT_RESULT[0]->Product_youtube;?>"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>

                                            </div>
                                            <p>
                                                <center>
                                                    <div class="btn-group btn-group-lg" role="group"
                                                        aria-label="Basic example">
                                                        <button type="button"
                                                            onclick="deletes('<?=base_url('Backend/delete/product');?>',<?=$PRODUCT_RESULT[0]->Product_id;?>)"
                                                            class="btn btn-danger btn-md">ลบข้อมูลสินค้า</button>
                                                        <button type="submit"
                                                            class="btn btn-success btn-md">บันทึกข้อมูล</button>
                                                    </div>
                                                </center>
                                            </p>
                                        </div>

                                        <div class="col-sm-7">
                                            <p>
                                                <span style="color: #011242;">ชื่อสินค้า: <input class="form-control" name="name_product"
                                                        type="text"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_name;?>"></span>
                                            </p>
                                            <p><span style="color: #011242;">คำอธิบาย: <input class="form-control" name="description"
                                                        type="text"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_description;?>"><span></p>

                                            <p><span style="color: #011242;">ราคาต่อชิ้น: <input class="form-control" name="price" type="text"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_price;?>"><span></p>
                                            <p><span style="color: #011242;">เหลือในสต๊อก: <input class="form-control" name="stocker"
                                                        type="text"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_stocker;?>"><span></p>
                                            <p><span style="color: #011242;">ลิงค์ยูทูป (นำตัวอักษรหลัง ?v= มาใส่): <input class="form-control"
                                                        name="youtube" type="text"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_youtube;?>"><span></p>
                                            <p><span style="color: #011242;">รูปภาพสินค้า (ไม่ใส่จะใช้ภาพเดิม): <input class="form-control"
                                                        name="product_img" type="file"
                                                        value="<?=$PRODUCT_RESULT[0]->Product_img;?>"><span></p>
                                            <p><span style="color: #011242;">ประเภทสินค้า: <select style="color: white;" id="product_cate" name="category" class="form-control">
                                                        <?php 
                                                $CATEGORY_SQL = $this->db->get('tbl_category');
                                                foreach($CATEGORY_SQL->result() as $CATEGORY){
                                                    echo '<option value="'.$CATEGORY->CategoryID.'">'.$CATEGORY->CategiryName.'</option>';
                                                }
                                                ?>

                                                    </select><span></p>
                                            <hr>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                            <h3 style="color: #011242;">รายละเอียด</h3>
                                            <textarea name="detail"
                                                class="form-control"><?=$PRODUCT_RESULT[0]->Product_detail;?></textarea>
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
<script>
    $('#product_cate').val(<?=$PRODUCT_RESULT[0]->Product_category;?>);
</script>
<?php $this->load->view('Template/frontend/footer'); ?>
