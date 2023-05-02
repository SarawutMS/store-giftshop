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
<?php 
		if(!empty($this->session->userdata('login-state'))){
			$this->db->where('Email',$this->session->userdata('email'));
			$User_query = $this->db->get("tbl_users");
			$User_result = $User_query->result();
		}
?>
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
                        <section class="card">
                            <div class="container py-5">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="text-dark card-body text-center">
                                                <img id="blah"
                                                    src="<?=base_url('assets/images/faces/'.$User_result[0]->Avatar);?>"
                                                    alt="avatar" class="img-lg rounded-circle">
                                                <h5 class="my-3"><?=$User_result[0]->FullName;?></h5>
                                                <p class="text-muted mb-1"><?=$User_result[0]->Role;?></p>
                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="<?=base_url('Profile/myorder');?>"
                                                        class="btn btn-outline-warning ms-1">ออเดอร์ของฉัน</a>&nbsp;
                                                    <a target="_blank" href="https://lin.ee/bki127A"
                                                        class="btn btn-outline-success ms-1">ติดต่อ Line</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 text-dark">

                                        <div id="myprofile" class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?=$User_result[0]->FullName;?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?=$User_result[0]->Email;?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?=$User_result[0]->Telephone;?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?=$User_result[0]->Address;?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">

                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><button type="button"
                                                                id="changepassword"
                                                                class="btn btn-outline-danger ms-1"><i class="fa fa-key"
                                                                    aria-hidden="true"></i>แก้ไขโปรไฟล์</button></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4 text-dark" style="display:none;" id="changepass_box">
                                            <!-- <form enctype="multipart/form-data" onSubmit='post_ajax("<?= base_url('Profile/changepassword'); ?>",$(this).serialize());return false;' method="post"> -->
                                            <form enctype="multipart/form-data"
                                                action="<?= base_url('Profile/changepassword'); ?>" method="post">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Full Name</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="FullName" class="form-control"
                                                                value="<?=$User_result[0]->FullName;?>">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Email</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0"><?=$User_result[0]->Email;?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Phone</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="Telephone" class="form-control"
                                                                value="<?=$User_result[0]->Telephone;?>">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Address</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <textarea name="Address" class="form-control"
                                                                rows="4"><?=$User_result[0]->Address;?></textarea>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Password </p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="Password" class="form-control">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Avatar </p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input onchange="readURL(this);" id="file_img" type="file"
                                                                name="avatar_image" class="form-control">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">

                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                <button type="button" id="return_changepassword"
                                                                    class="btn btn-outline-success ms-1"><i
                                                                        class="fa fa-key" aria-hidden="true"></i>
                                                                    กลับหน้าโปรไฟล์</button>
                                                                <button type="submit"
                                                                    class="btn btn-outline-warning ms-1"><i
                                                                        class="fa fa-save" aria-hidden="true"></i>
                                                                    บันทึกข้อมูล</button>
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span
                                                                class="text-primary font-italic me-1">assigment</span>
                                                            Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup
                                                        </p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 72%" aria-valuenow="72" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 89%" aria-valuenow="89" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template
                                                        </p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span
                                                                class="text-primary font-italic me-1">assigment</span>
                                                            Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup
                                                        </p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 72%" aria-valuenow="72" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 89%" aria-valuenow="89" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template
                                                        </p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </section>
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $this->load->view('Template/frontend/footer'); ?>