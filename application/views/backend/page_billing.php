<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i>
                                    รายละเอียดสินค้าทั้งหมด</h4>
                                <a href="<?=base_url('Backend/manager/product/add');?>" class="btn btn-success">Add
                                    Product</a>
                                <hr>
                                <div class="table-responsive text-dark">
                                    <table id="myTable" class="table text-#011242">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Img</th>
                                                <th scope="col">Payment Users</th>
                                                <th scope="col">Payment Amount</th>
                                                <th scope="col">Payment Time</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-#011242">
                                            <?php 
                                         $i = 0;
                                foreach($Billing as $Billings){
                                    $i++;
                                    echo '
                                        <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td><img src="'.base_url('assets/images/Payment/'.$Billings->Topup_img).'" class="card-img-top"></td>
                                            <td>'.$Billings->Topup_User.'</td>
                                            <td>'.$Billings->Topup_Amount.'</td>
                                            <td>'.$Billings->Topup_Time.'</td>
                                            <td>
                                                <button onclick="img_zoom(\''.base_url('assets/images/Payment/'.$Billings->Topup_img).'\')" class="btn btn-info"><i class="fa-solid fa-image"></i> บิล</button>
                                                <button class="btn btn-warning"><i class="fa-regular fa-eye"></i> View</button>
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
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"
                        style="color: #6c7293;">Copyright ©
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


<?php $this->load->view('Template/frontend/footer'); ?>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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


$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>