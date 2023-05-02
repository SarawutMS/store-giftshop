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
.card-body-2{
    overflow: auto;
    max-height: 50;
    height: 100px;
    /* background-color: #06060638; */
}

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
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

.btn{

    font-size: 20px;
    text-align: center;
    line-height: 25px;
    color: rgba(255, 255, 255, 0.9);
    border-radius: 50px;
    background: linear-gradient(-45deg, #FFA63D, #FF3D77, #338AFF, #3CF0C5);
    background-size: 600%;
    animation: anime 16s linear infinite;
    opacity: 0.8;
}

@keyframes anime {
    0% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }

    100% {
        background-position: 0% 50%;
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
                                <h4 class="card-title" style="color: #011242;"><i class="mdi mdi-store"></i> รายละเอียดสินค้าทั้งหมด</h4>
                                <hr>
                                <div class="row">
                                    <?php 
                                $PRODUCT_TABLE = $this->db->get('tbl_product');
                                $ROWS = $PRODUCT_TABLE->num_rows();
                                $PAGE_ROWS = 12;
                                $LAST_PAGE = ceil($ROWS/$PAGE_ROWS);
                                if($LAST_PAGE < 1){
                                    $LAST_PAGE = 1;
                                }
                            
                                $PAGE_NUM = 1;
                            
                                if(isset($_GET['pn'])){
                                    $get = $this->input->get();
                                    $PAGE_NUM = preg_replace('#[^0-9]#', '',$get['pn']);
                                }
                            
                                if ($PAGE_NUM < 1) {
                                    $PAGE_NUM = 1;
                                }
                                else if ($PAGE_NUM > $LAST_PAGE) {
                                    $PAGE_NUM = $LAST_PAGE;
                                }
                            
                                $LIMITES = ' LIMIT ' .($PAGE_NUM - 1) * $PAGE_ROWS .',' .$PAGE_ROWS;
                                $PRODUCT_TABLE_TWO = $this->db->query('SELECT * FROM tbl_product WHERE Product_category = '.$category.$LIMITES.';');
                                

                                
                                $PAGINATIONCTRLS = '';

                                if($LAST_PAGE != 1){

                                    if ($PAGE_NUM > 1) {
                                        $previous = $PAGE_NUM - 1;
                                        $PAGINATIONCTRLS .= '<li class="page-item"><a class="page-link" href="'.base_url('product?pn='.$previous).'">Previous</a></li>';


                                        for($i = $PAGE_NUM-4; $i < $PAGE_NUM; $i++){
                                            if($i > 0){
                                                $PAGINATIONCTRLS .= '<li class="page-item"><a class="page-link" href="'.base_url('product?pn='.$i).'">'.$i.'</a></li>';
                                            }
                                        }
                                    }

                                    $PAGINATIONCTRLS .= ' <li class="page-item active" aria-current="page"><a class="page-link" href="#">'.$PAGE_NUM.'</a></li>';

                                    for($i = $PAGE_NUM+1; $i <= $LAST_PAGE; $i++){
                                        $PAGINATIONCTRLS .= '<li class="page-item"><a class="page-link" href="'.base_url('product?pn='.$i).'">'.$i.'</a></li>';
                                        if($i >= $PAGE_NUM+4){
                                            break;
                                        }
                                    }

                                    if ($PAGE_NUM != $LAST_PAGE) {
                                        $NEXT = $PAGE_NUM + 1;
                                        $PAGINATIONCTRLS .= '<li class="page-item"><a class="page-link" href="'.base_url('product?pn='.$NEXT).'">Next</a></li>';
                                    }
                                }

                                foreach($PRODUCT_TABLE_TWO->result() as $PRODUCT){
                                    echo '
                                    <div class="col-sm-3">
                                            <div class="card text-dark"><!-- Product Result  -->
                                                <div class="hover14">
                                                    <figure><img src="'.base_url('assets/images/product/'.$PRODUCT->Product_img).'" class="card-img-top"></figure>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-text">'.$PRODUCT->Product_name.'</h3>
                                                    <p class="card-text card-body-2">'.$PRODUCT->Product_description.'</p>
                                                    <div class="d-grid gap-2">
                                                        <a href="'.base_url('product/detail/'.$PRODUCT->Product_id).'" type="button" class="btn btn-outline-primary btn-block">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div> <!-- End Product Result  -->
                                    </div>
                                    
                                    ';
                                }
                                ?>
                                </div>
                                <hr>
                                <?php 
                                echo '
                                    <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        '.$PAGINATIONCTRLS.'
                                    </ul>
                                    </nav>
                                    ';
                                ?>
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
