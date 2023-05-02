<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
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
                    <div class="col-12 grid-margin" id="cate_step_1">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"  style="color: #011242;"><i class="mdi mdi-store"></i> ประเภทสินค้า</h4>
                                    <button onclick="add_category()" type="button" class="btn btn-success">Add Category</button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table text-#011242">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-#011242">
                                            <?php 
                                $i = 0;
                                foreach($CATEGORY_RESULT as $CATEGORY){
                                    $i++;
                                    echo '
                                        <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$CATEGORY->CategiryName.'</td>
                                            <td>
                                                <button onclick="category(\''.$CATEGORY->CategiryName.'\','.$CATEGORY->CategoryID.')" type="button" class="btn btn-warning">Edit</a>
                                                <button onclick="deletes(\''.base_url('Backend/delete/category').'\','.$CATEGORY->CategoryID.')" type="button" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    
                                    ';
                                }
                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin" style="display: none;" id="cate_step_2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi mdi-store"></i> แก้ไขประเภทสินค้า</h4>
                                <hr>
                                <form enctype="multipart/form-data" method="post"
                                    action="<?=base_url('Backend/save/category_edit');?>">
                                    <p>
                                        <span>ชื่อประเภท: <input class="form-control" id="category_name"
                                                name="category_name" type="text" value=""></span>
                                    </p>
                                    <input class="form-control" id="category_id" name="category_id" type="hidden"
                                        value="">
                                    <div class="btn-group btn-group-md" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-success btn-md">บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin" style="display: none;" id="cate_step_3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi mdi-store"></i> เพิ่มประเภทสินค้า</h4>
                                <hr>
                                <form enctype="multipart/form-data" method="post"
                                    action="<?=base_url('Backend/save/category_add');?>">
                                    <p>
                                        <span>ชื่อประเภท: <input class="form-control" id="category_name"
                                                name="category_name" type="text" value=""></span>
                                    </p>
                                    <div class="btn-group btn-group-md" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-success btn-md">บันทึกข้อมูล</button>
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
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
