<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Template/frontend/head'); ?>
<style>
body {
    background: black;
}

.box {
    position: relative;
}

.box::before {
    content: "";
    width: 440px;
    height: 440px;
    background-color: #89cff0;
    position: absolute;
    z-index: -1;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    border-radius: 50%;
}

.box-body {
    position: relative;
    height: 200px;
    width: 200px;
    margin-top: 123.3333333333px;
    background-color: #cc231e;
    border-bottom-left-radius: 5%;
    border-bottom-right-radius: 5%;
    box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.3);
    background: linear-gradient(#762c2c, #ff0303);
}

.box-body .img {
    opacity: 0;
    ransform: translateY(0%);
    transition: all 0.5s;
    margin: 0 auto;
    display: block;
}

.box-body:hover {
    cursor: pointer;
    -webkit-animation: box-body 1s forwards ease-in-out;
    animation: box-body 1s forwards ease-in-out;
}

.box-body:hover .img {
    opacity: 1;
    z-index: 0;
    transform: translateY(-157px);



}

.box-body:hover .box-lid {
    -webkit-animation: box-lid 1s forwards ease-in-out;
    animation: box-lid 1s forwards ease-in-out;
}

.box-body:hover .box-bowtie::before {
    -webkit-animation: box-bowtie-left 1.1s forwards ease-in-out;
    animation: box-bowtie-left 1.1s forwards ease-in-out;
}

.box-body:hover .box-bowtie::after {
    -webkit-animation: box-bowtie-right 1.1s forwards ease-in-out;
    animation: box-bowtie-right 1.1s forwards ease-in-out;
}

.box-body::after {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    width: 50px;
    background: linear-gradient(#ffffff, #ffefa0)
}

.box-lid {
    position: absolute;
    z-index: 1;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    bottom: 90%;
    height: 40px;
    background-color: #cc231e;
    height: 40px;
    width: 220px;
    border-radius: 5%;
    box-shadow: 0 8px 4px -4px rgba(0, 0, 0, 0.3);
}

.box-lid::after {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    width: 50px;
    background: linear-gradient(#ffefa0, #fff)
}

.box-bowtie {
    z-index: 1;
    height: 100%;
}

.box-bowtie::before,
.box-bowtie::after {
    content: "";
    width: 83.3333333333px;
    height: 83.3333333333px;
    border: 16.6666666667px solid white;
    border-radius: 50% 50% 0 50%;
    position: absolute;
    bottom: 99%;
    z-index: -1;
}

.box-bowtie::before {
    left: 50%;
    -webkit-transform: translateX(-100%) skew(10deg, 10deg);
    transform: translateX(-100%) skew(10deg, 10deg);
}

.box-bowtie::after {
    left: 50%;
    -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
    transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
}

@-webkit-keyframes box-lid {

    0%,
    42% {
        -webkit-transform: translate3d(-50%, 0%, 0) rotate(0deg);
        transform: translate3d(-50%, 0%, 0) rotate(0deg);
    }

    60% {
        -webkit-transform: translate3d(-85%, -230%, 0) rotate(-25deg);
        transform: translate3d(-85%, -230%, 0) rotate(-25deg);
    }

    90%,
    100% {
        -webkit-transform: translate3d(-119%, 225%, 0) rotate(-70deg);
        transform: translate3d(-119%, 225%, 0) rotate(-70deg);
    }
}

@keyframes box-lid {

    0%,
    42% {
        -webkit-transform: translate3d(-50%, 0%, 0) rotate(0deg);
        transform: translate3d(-50%, 0%, 0) rotate(0deg);
    }

    60% {
        -webkit-transform: translate3d(-85%, -230%, 0) rotate(-25deg);
        transform: translate3d(-85%, -230%, 0) rotate(-25deg);
    }

    90%,
    100% {
        -webkit-transform: translate3d(-119%, 225%, 0) rotate(-70deg);
        transform: translate3d(-119%, 225%, 0) rotate(-70deg);
    }
}

@-webkit-keyframes box-body {
    0% {
        -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);
        transform: translate3d(0%, 0%, 0) rotate(0deg);
    }

    25% {
        -webkit-transform: translate3d(0%, 25%, 0) rotate(20deg);
        transform: translate3d(0%, 25%, 0) rotate(20deg);
    }

    50% {
        -webkit-transform: translate3d(0%, -15%, 0) rotate(0deg);
        transform: translate3d(0%, -15%, 0) rotate(0deg);
    }

    70% {
        -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);
        transform: translate3d(0%, 0%, 0) rotate(0deg);
    }
}

@keyframes box-body {
    0% {
        -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);
        transform: translate3d(0%, 0%, 0) rotate(0deg);
    }

    25% {
        -webkit-transform: translate3d(0%, 25%, 0) rotate(20deg);
        transform: translate3d(0%, 25%, 0) rotate(20deg);
    }

    50% {
        -webkit-transform: translate3d(0%, -15%, 0) rotate(0deg);
        transform: translate3d(0%, -15%, 0) rotate(0deg);
    }

    70% {
        -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);
        transform: translate3d(0%, 0%, 0) rotate(0deg);
    }
}

@-webkit-keyframes box-bowtie-right {

    0%,
    50%,
    75% {
        -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
        transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
    }

    90%,
    100% {
        -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        box-shadow: 0px 4px 8px -4px rgba(0, 0, 0, 0.3);
    }
}

@keyframes box-bowtie-right {

    0%,
    50%,
    75% {
        -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
        transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);
    }

    90%,
    100% {
        -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        box-shadow: 0px 4px 8px -4px rgba(0, 0, 0, 0.3);
    }
}

@-webkit-keyframes box-bowtie-left {
    0% {
        -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
        transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
    }

    50%,
    75% {
        -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
    }

    90%,
    100% {
        -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
        transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
    }
}

@keyframes box-bowtie-left {
    0% {
        -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
        transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
    }

    50%,
    75% {
        -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
        transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);
    }

    90%,
    100% {
        -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
        transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);
    }
}


.firework {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0.5vmin;
    aspect-ratio: 1;
    background:
        /* background intentionally blank */
    ;
    background-size: 0.5vmin 0.5vmin;
    background-repeat: no-repeat;
}

@keyframes firework {
    0% {
        transform: translate(var(--x), var(--initialY));
        width: var(--initialSize);
        opacity: 1;
    }

    50% {
        width: 0.5vmin;
        opacity: 1;
    }

    100% {
        width: var(--finalSize);
        opacity: 0;
    }
}

/* @keyframes fireworkPseudo {
  0% { transform: translate(-50%, -50%); width: var(--initialSize); opacity: 1; }
  50% { width: 0.5vmin; opacity: 1; }
  100% { width: var(--finalSize); opacity: 0; }
}
 */
.firework,
.firework::before,
.firework::after {
    --initialSize: 0.5vmin;
    --finalSize: 45vmin;
    --particleSize: 0.2vmin;
    --color1: yellow;
    --color2: khaki;
    --color3: white;
    --color4: lime;
    --color5: gold;
    --color6: mediumseagreen;
    --y: -30vmin;
    --x: -50%;
    --initialY: 60vmin;
    content: "";
    animation: firework 2s infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, var(--y));
    width: var(--initialSize);
    aspect-ratio: 1;
    background:
        /*
    radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 0% 0%,
    radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 100% 0%,
    radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 100% 100%,
    radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 0% 100%,
    */

        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 50% 0%,
        radial-gradient(circle, var(--color2) var(--particleSize), #0000 0) 100% 50%,
        radial-gradient(circle, var(--color3) var(--particleSize), #0000 0) 50% 100%,
        radial-gradient(circle, var(--color4) var(--particleSize), #0000 0) 0% 50%,

        /* bottom right */
        radial-gradient(circle, var(--color5) var(--particleSize), #0000 0) 80% 90%,
        radial-gradient(circle, var(--color6) var(--particleSize), #0000 0) 95% 90%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 90% 70%,
        radial-gradient(circle, var(--color2) var(--particleSize), #0000 0) 100% 60%,
        radial-gradient(circle, var(--color3) var(--particleSize), #0000 0) 55% 80%,
        radial-gradient(circle, var(--color4) var(--particleSize), #0000 0) 70% 77%,

        /* bottom left */
        radial-gradient(circle, var(--color5) var(--particleSize), #0000 0) 22% 90%,
        radial-gradient(circle, var(--color6) var(--particleSize), #0000 0) 45% 90%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 33% 70%,
        radial-gradient(circle, var(--color2) var(--particleSize), #0000 0) 10% 60%,
        radial-gradient(circle, var(--color3) var(--particleSize), #0000 0) 31% 80%,
        radial-gradient(circle, var(--color4) var(--particleSize), #0000 0) 28% 77%,
        radial-gradient(circle, var(--color5) var(--particleSize), #0000 0) 13% 72%,

        /* top left */
        radial-gradient(circle, var(--color6) var(--particleSize), #0000 0) 80% 10%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 95% 14%,
        radial-gradient(circle, var(--color2) var(--particleSize), #0000 0) 90% 23%,
        radial-gradient(circle, var(--color3) var(--particleSize), #0000 0) 100% 43%,
        radial-gradient(circle, var(--color4) var(--particleSize), #0000 0) 85% 27%,
        radial-gradient(circle, var(--color5) var(--particleSize), #0000 0) 77% 37%,
        radial-gradient(circle, var(--color6) var(--particleSize), #0000 0) 60% 7%,

        /* top right */
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 22% 14%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 45% 20%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 33% 34%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 10% 29%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 31% 37%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 28% 7%,
        radial-gradient(circle, var(--color1) var(--particleSize), #0000 0) 13% 42%;
    background-size: var(--initialSize) var(--initialSize);
    background-repeat: no-repeat;
}

.firework::before {
    --x: -50%;
    --y: -50%;
    --initialY: -50%;
    /*   transform: translate(-20vmin, -2vmin) rotate(40deg) scale(1.3) rotateY(40deg); */
    transform: translate(-50%, -50%) rotate(40deg) scale(1.3) rotateY(40deg);
    /*   animation: fireworkPseudo 2s infinite; */
}

.firework::after {
    --x: -50%;
    --y: -50%;
    --initialY: -50%;
    /*   transform: translate(44vmin, -50%) rotate(170deg) scale(1.15) rotateY(-30deg); */
    transform: translate(-50%, -50%) rotate(170deg) scale(1.15) rotateY(-30deg);
    /*   animation: fireworkPseudo 2s infinite; */
}

.firework:nth-child(2) {
    --x: 30vmin;
}

.firework:nth-child(2),
.firework:nth-child(2)::before,
.firework:nth-child(2)::after {
    --color1: pink;
    --color2: violet;
    --color3: fuchsia;
    --color4: orchid;
    --color5: plum;
    --color6: lavender;
    --finalSize: 40vmin;
    left: 30%;
    top: 60%;
    animation-delay: -0.25s;
}

.firework:nth-child(3) {
    --x: -30vmin;
    --y: -50vmin;
}

.firework:nth-child(3),
.firework:nth-child(3)::before,
.firework:nth-child(3)::after {
    --color1: cyan;
    --color2: lightcyan;
    --color3: lightblue;
    --color4: PaleTurquoise;
    --color5: SkyBlue;
    --color6: lavender;
    --finalSize: 35vmin;
    left: 70%;
    top: 60%;
    animation-delay: -0.4s;
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
                                <h4 class="card-title" style="color: #011242;">Online Card - สร้างของขวัญออนไลน์</h4>
                                <hr>

                                <form enctype="multipart/form-data" action="<?= base_url('Online/InsertGift'); ?>"
                                    method="post">
                                    <div class="form-group" style="color: #011242;">
                                        <label>คำอวยพร</label>
                                        <input type="text" name="OnlineWish" name="Online_Sender" class="form-control">
                                    </div>
                                    <div class="form-group" style="color: #011242;">
                                        <label>ชื่อผู้ส่ง</label>
                                        <input type="text" name="OnlineSender" class="form-control">
                                    </div>
                                    <div class="form-group" style="color: #011242;">
                                        <label>ชื่อผู้รับ</label>
                                        <input type="text" name="OnlineRev" class="form-control">
                                    </div>
                                    <div class="form-group" style="color: #011242;">
                                        <label>ลิงค์ของขวัญ ( ทรูวอเลต ** ไม่จำเป็นต้องใส่ก็ได้ **)</label>
                                        <input type="url" name="OnlineLink" class="form-control">
                                    </div>
                                    <div class="form-group" style="color: #011242;">
                                        <label>รูปภาพของขวัญเช่น สลิปเงิน หรืออื่นๆ (** ไม่จำเป็นต้องใส่ก็ได้ **)</label>
                                        <input name="Online_img" onchange="readURL(this);" type="file" class="form-control">
                                    </div>
                                     <!--<div class="form-group" style="color: #011242;">
                                        <label>Avatar ที่เลือก</label>
                                        <input id="Online_avatar" name="Online_avatar" type="hidden" value="" class="form-control">
                                        <br>
                                        <img id="avatar_ex" width="150" src="https://via.placeholder.com/150" class="img-thumbnail" alt="...">
                                    </div>-->
                                    <button type="submit" class="btn btn-primary">ดำเนินการต่อ</button>
                                    <a href="<?=base_url('Online/mygift');?>" class="btn btn-success">ของขวัญของฉัน</a>
                                </form>
                                 <!--<hr>
                               	<div class="alert alert-secondary text-white" style="background-color: #8295cb;border-color: #5e7d8d;" role="alert">
                                    หากต้องการให้แอดมินวาดรูปแนวมินิมอล <a target="_blank" href="https://lin.ee/bki127A" target="_blank" class="text-white alert-link">Click</a> ที่นี้
                                </div>
                                <hr>
                                <h3>เลือก Avatar</h3>
                                <hr>

                                <div class="owl-carousel owl-theme">
                                    <?php
                                    		if(!empty($this->session->userdata('login-state'))){
                                                $this->db->where('Email',$this->session->userdata('email'));
                                                $User_query = $this->db->get("tbl_users");
                                                $User_result = $User_query->result();
                                            }
                                            if($User_result[0]->Role == 'user' or $User_result[0]->Role == 'superadmin'){
                                                $this->db->where('Permission','normal');
                                            }
                                    $IMG_SQL = $this->db->get('tbl_images');

                                    foreach($IMG_SQL->result() as $IMG_RESULT){
                                      echo 
                                      '
                                      <div class="item" style="width:200px">
                                        <button style="background-color: none;" type="button">
                                            <h4><img onclick="changeIts(this.src)" src="'.base_url('assets/images/Gallery/'.$IMG_RESULT->ImgName).'" class="card-img-top"></h4>
                                        </button>
                                      </div>
                                      ';
                                    }
                                  ?>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class=" d-block text-center text-sm-left d-sm-inline-block" style="color: #6c7293;">Copyright &copy;
						sarawut.ms 5168</span>

                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1600: {
                items: 5
            }
        }
    })
});

function changeIts(_src){
    $('#avatar_ex').attr('src', _src);
    $('#Online_avatar').val(_src);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $this->load->view('Template/frontend/footer'); ?>
