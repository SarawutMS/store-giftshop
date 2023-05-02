<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<style>
.form-control, .asColorPicker-input, .dataTables_wrapper select, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text], .jsgrid .jsgrid-table .jsgrid-filter-row select, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number], .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-search__field, .typeahead, .tt-query, .tt-hint {
    border: 1px solid #2c2e33;
    height: calc(2.25rem + 2px);
    /* font-weight: normal; */
    font-size: 0.875rem;
    padding: 0.625rem 0.6875rem;
    background-color: #2A3038;
    border-radius: 2px;
    color: #ffffff;
}
.btn-primary, .wizard > .actions a {
    color: #dd0c0c;
    background-color: #5091f3;
    border-color: #0090e7;
}
</style>
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto" style="background-color: #ffffff;">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3" style="color: #011242;">Login - เข้าสู่ระบบ</h3>
                <form onSubmit='post_ajax("<?= base_url('auth/sign-in'); ?>",$(this).serialize());return false;' method="post">
                  <div class="form-group" style="color: #011242;">
                    <label>email *</label>
                    <input type="text" name="Email" class="form-control p_input">
                  </div>
                  <div class="form-group" style="color: #011242;">
                    <label>Password *</label>
                    <input type="password" name="Password" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">เข้าสู่ระบบ</button>
                    <a href="<?=base_url('');?>" class="btn btn-success btn-block enter-btn">กลับเข้าหน้าหลัก</a>
                  </div>
                  <p class="sign-up" style="color: #011242;">คุณยังไม่มีบัญชีใช่ไหม?<a href="<?=base_url('sign-up');?>"> สมัครเลย</a></p>
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