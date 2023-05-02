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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> ประเภทสินค้า</h4>
                                    <button onclick="add_category()" type="button" class="btn btn-success">Add Category</button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table text-#011242">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ชื่อผู้รับ</th>
                                                <th scope="col">ชื่อผู้ส่ง</th>
                                                <th scope="col">คำอวยพร</th>
                                                <th scope="col">ของขวัญ</th>
                                                <th scope="col">รูป</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-#011242">
                                            <?php 
                                $i = 0;
                                foreach($ONLINE_RESULT as $ONLINE){
                                    $i++;
                                    echo '
                                        <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$ONLINE->OnlineRev.'</td>
                                            <td>'.$ONLINE->OnlineSender.'</td>
                                            <td>'.$ONLINE->OnlineWish.'</td>
                                            <td><button class="btn btn-copy '; if(empty($ONLINE->OnlineLink)){echo 'btn-warning';}else{echo 'btn-success';} echo '" data-clipboard-text="'.$ONLINE->OnlineLink.'"><i class="mdi mdi-content-copy"></i></button></td>
                                            <td><img src="'.base_url('assets/images/gift/'.$ONLINE->OnlineIMG).'" class="card-img-top"></td>
                                            <td>
                                                <a target="_blank" href="'.base_url('Online/gift/'.$ONLINE->OnlineID).'" class="btn btn-info"><i class="mdi mdi-eye"></i> Preview</a>
                                                <button onclick="deletes(\''.base_url('Backend/delete/online').'\','.$ONLINE->OnlineID.')" type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i> Delete</button>
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

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
var clipboard = new ClipboardJS('.btn-copy');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>

<?php $this->load->view('Template/frontend/footer'); ?>
