<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3" style="color: #011242;">Register - สมัครสมาชิก</h3>
                <form onSubmit='post_ajax("<?= base_url('auth/sign-up'); ?>",$(this).serialize());return false;' method="post">
                  <div class="form-group" style="color: #011242;">
                    <label>email *</label>
                    <input required type="text" name="Email" class="form-control p_input">
                  </div>
                  <div class="form-group" style="color: #011242;">
                    <label>Password *</label>
                    <input required type="password" name="Password" class="form-control p_input">
                  </div>
                  <div class="form-group" style="color: #011242;">
                    <label>Confirm Password *</label>
                    <input required type="password" name="ConfirmPassword" class="form-control p_input">
                  </div>
                  <div class="text-center" style="color: #011242;">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">สมัครสมาชิก</button>
                    <a href="<?=base_url('');?>" class="btn btn-success btn-block enter-btn">กลับเข้าหน้าหลัก</a>
                  </div>
                  <hr>
                  <!--<center><div class="g-recaptcha" data-sitekey="6Lfscx8jAAAAAEpctGAKByOMZwXQdqgapVr9A2mW" ></div></center>-->
                  <p class="sign-up" style="color: #011242;">คุณมี Account อยู่แล้วใช่ไหม?<a href="<?=base_url('sign-in');?>"> มีบัญชีอยุ่แล้ว</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
<?php $this->load->view('Template/frontend/footer'); ?>