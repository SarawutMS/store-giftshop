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
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> รายละเอียดสินค้าทั้งหมด</h4>
                                <a href="<?=base_url('Backend/manager/product/add');?>" class="btn btn-success">Add Product</a>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table text-#011242">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Img</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Discription</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-#011242">
                                            <?php 
                                         $i = 0;
                                foreach($PRODUCT_RESULT as $PRODUCT){
                                    $i++;
                                    echo '
                                        <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td><img src="'.base_url('assets/images/product/'.$PRODUCT->Product_img).'" class="card-img-top"></td>
                                            <td>'.$PRODUCT->Product_name.'</td>
                                            <td>'.$PRODUCT->Product_description.'</td>
                                            <td>'.$PRODUCT->Product_stocker.'</td>
                                            <td>'.$PRODUCT->Product_price.'</td>
                                            <td>
                                                <a href="'.base_url('Backend/manager/product/edit/'.$PRODUCT->Product_id).'" class="btn btn-warning">Edit</a>
                                                <button onclick="deletes(\''.base_url('Backend/delete/product').'\','.$PRODUCT->Product_id.')" type="button" class="btn btn-danger">Delete</button>
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
