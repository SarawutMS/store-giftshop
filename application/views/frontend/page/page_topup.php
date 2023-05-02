<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
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
                                <h4 class="card-title" style="color: #011242;"><i class="fa-solid fa-money-bill"></i>
                                ชำระเงิน/หลักฐาน</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?=base_url('assets/images/IMG_5953.jpg');?>" alt=""
                                            class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <form id="topup_submit" method="post" action="" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="amounts" class="form-label">จำนวนเงินที่โอน</label>
                                                <input required class="form-control xd-input" type="text" name="amount" id="amounts">
                                                <input required class="form-control" type="hidden" value="<?=$order_id;?>"id="order_id">
                                            </div>
                                            <div class="mb-3">
                                                <label for="time" class="form-label">เวลาที่ทำรายการ</label>
                                                <input required class="form-control" type="datetime-local" name="datetime"
                                                    id="time">
                                            </div>
                                            <div class="mb-3">
                                                <label for="filer" class="form-label">ไฟล์หลักฐานการโอนเงิน (.png ,
                                                    jpg)</label>
                                                <input required class="form-control" type="file" name="file" id="filer">
                                            </div>
                                            <div class="d-grid gap-2">
                                                <a href="<?=base_url('product/order/detail/'.$order_id);?>" class="btn btn-success" type="submit">ข้อมูลออเดอร์</a>
                                                <button class="btn btn-primary" type="submit">ส่งหลักฐาน</button>
                                            </div>
                                        </form>
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
                    <span class=" d-block text-center text-sm-left d-sm-inline-block" style="color: #6c7293;">Copyright
                        &copy;
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
 
var cleave = new Cleave('.xd-input', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

 $("#topup_submit").on("submit", function(e) {
        const swalWithBootstrapButtons = Swal.mixin({
            buttonsStyling: true,
        })
        titles = "<h1 style='color:black'>แจ้งเตือน</h1>";
        e.preventDefault();
        var fd = new FormData();
        var files = $('#filer')[0].files;
        fd.append('files', files[0]);
        var number = $("#amounts").val().replace(",", "");
        console.log(number);
        fd.append('amounts', number);
        fd.append('time', $("#time").val());
        fd.append('order_id', $("#order_id").val());
        swalWithBootstrapButtons.showLoading()
        $.ajax({
            url: '<?=base_url('topup/process');?>',
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(obj) {
                swalWithBootstrapButtons.hideLoading()
                if (obj.type == "success") {
                    swalWithBootstrapButtons.fire({
                        title: titles,
                        text: obj.alert,
                        icon: obj.type,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (obj.target != '') {
                                window.location.href = obj.target;
                            }
                        }
                    })
                } else {
                    swalWithBootstrapButtons.fire({
                        title: titles,
                        text: obj.alert,
                        icon: obj.type,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (obj.target != '') {
                                window.location.href = obj.target;
                            }
                        }
                    })
                    // swalWithBootstrapButtons.fire(titles, obj.alert, obj.type)
                }
            }
        });
    });
 
</script>
<?php $this->load->view('Template/frontend/footer'); ?>