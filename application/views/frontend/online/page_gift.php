<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gift for you</title>
    <link rel="shortcut icon" href="<?=base_url('assets/images/pngwing2.png');?>" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />

</head>
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <div class="present" id="present">
        <div class="name" style="right:16%;  display: flex;align-items: center; position:fixed; z-index: 9;">
            <div class="card" style="max-width: 500px; width: 500px;">
                <div class="card-body">
                    <center class="text-black">
                        <b><?=$ONLINE[0]->OnlineWish;?></b></br>
                        <?php if(!empty($ONLINE[0]->OnlineIMG)): ?>
                        <a data-mdb-toggle="modal" href="#exampleModalToggle1" role="button"
                            class="btn btn-success text-white"><i class="fas fa-images"></i></a>
                        <?php endif; ?>
                        <hr>
                        <?php if(!empty($ONLINE[0]->OnlineLink)): ?>
                        <a class="btn text-white" target="_blank"
                            style="display:none; background-color: #edad20; right: 30%; top: -15%; position:fixed; z-index: 9;"
                            href="<?=$ONLINE[0]->OnlineLink;?>" role="button">
                            <i class="text-black fas fa-wallet me-2"></i>
                            กดรับของขวัญ
                        </a>
                        <?php endif; ?>
                        <b style="font-size: 12px;">ของขวัญให้คุณ: <?=$ONLINE[0]->OnlineRev;?></b>
                    </center>
                </div>
            </div>
        </div>
        <div class="rotate-container">
            <div class="bottom"></div>
            <div class="front"></div>
            <div class="left"></div>
            <div class="back"></div>
            <div class="right"></div>

            <div class="lid">
                <div class="lid-top"></div>
                <div class="lid-front"></div>
                <div class="lid-left"></div>
                <div class="lid-back"></div>
                <div class="lid-right"></div>
            </div>
        </div>
    </div>
    <img class="animate__shakeX animate__infinite animate__slower animate__animated"
            style="display: flex; right: 70%; top: 60%; position:fixed; z-index: 1; width: 100%"
            src="<?=$ONLINE[0]->OnlineAvatar;?>">

    <div class="firework"></div>
    <div class="firework"></div>
    <div class="firework"></div>
    <!--<footer>

        <center> CopyRight 2022 - 2023 &copy; By <a target="_blank" href="<?=base_url('');?>">Angelo-giftz.com</a>
        </center>
    </footer>-->
    <audio id="music">
        <source src="<?=base_url('assets/audio/music.mp3');?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>


    <!-- First modal dialog -->
    <div class="modal fade" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel1">Modal 1</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img style="z-index: -1;" class="img" id="blah" width="100%"
                        src="<?=base_url('assets/images/gift/'.$ONLINE[0]->OnlineIMG);?>">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
<script>
"use strict";
const sound = document.getElementById("music");
var open = false;
$('.name').fadeOut();
$('.btn').fadeOut();
$('#present').click(function() {
    if (open == false) {
        present.classList.toggle('open'), $('.name').fadeIn(), $('.btn').fadeIn(), sound.play()
        open = true;
    } else {
        //open = false;
        //present.classList.toggle('open'), $('.name').fadeOut(), $('.btn').fadeOut(), sound.stop()
    }
});
</script>
<style>
html {
    box-sizing: border-box;
}

*,
*:after,
*:before {
    box-sizing: inherit;
}

@keyframes gradient {
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

body {
    color: #fff;
    font-family: 'Lato', sans-serif;
    overflow: hidden;

    /*background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);*/
	background: linear-gradient(90deg, #182d67, #e73c7e, #23a6d5, #FFC000, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 10s ease infinite;
    height: 100vh;
}

.present {
    height: 240px;
    left: 0;
    margin: 0 auto;
    perspective: 600px;
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 240px;
}

.name {
    font-size: 1.0em;
    font-weight: 100;
    position: absolute;
    top: 50%;
    left: -30%;
    line-height: 2;
    width: 400px;
}

/* .name b {
    display: inline-block;
    width: 60px;
} */

.instruction {
    bottom: -100px;
    left: 0;
    opacity: 1;
    position: absolute;
    text-align: center;
    transition: opacity 0.5s;
    width: 100%;
}

.rotate-container {
    animation: present-rotate 5s infinite linear;
    height: 100%;
    transform: rotateY(170deg);
    transform-style: preserve-3d;
}

@keyframes present-rotate {
    0% {
        transform: rotateY(0);
    }

    100% {
        transform: rotateY(360deg);
    }
}

.bottom,
.front,
.left,
.back,
.right {
    background-color: #fff; รอบกล่อง
    border: 1px solid rgba(0, 0, 0, .2);
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}

.bottom {
    transform: translateY(50%) rotateX(90deg);
}

.front,
.left,
.back,
.right {
    transition: transform 0.5s;
    transform-origin: bottom;
    transform-style: preserve-3d;
}

.front:after,
.left:after,
.back:after,
.right:after,
.lid-top:after,
.lid-front:after,
.lid-left:after,
.lid-back:after,
.lid-right:after {
    background-color: #ec0910;
    box-shadow: 0 0 5px rgba(0, 0, 0, .2);
    content: '';
    height: 100%;
    left: calc(50% - 10px);
    position: absolute;
    transform: translateZ(0.1px);
    width: 20px;
}

.lid-top:before {
    background-color: #ec0910;
    box-shadow: 0 0 5px rgba(0, 0, 0, .2);
    content: '';
    height: 20px;
    left: 0;
    position: absolute;
    top: calc(50% - 10px);
    transform: translateZ(0.1px);
    width: 100%;
}

.left {
    transform: translateX(-50%) rotateY(-90deg);
}

.back {
    transform: translateZ(-120px) rotateY(180deg) rotateX(0);
}

.right {
    transform: translateX(50%) rotateY(90deg);
}

.front {
    transform: translateZ(120px);
}

.lid {
    animation: lid-animation 3.5s 1s infinite;
    transform: translate3d(0, 0, 0);
    transform-style: preserve-3d;
    transition: transform 0.5s;
}

@keyframes lid-animation {
    0% {
        transform: translate3d(0, 0, 0) rotateX(0);
    }

    5% {
        transform: translate3d(0, -10px, -5px) rotateX(5deg);
    }

    10% {
        transform: translate3d(0, -10px, 5px) rotateX(-5deg);
    }

    15% {
        transform: translate3d(0, -10px, -5px) rotateX(5deg);
    }

    20% {
        transform: translate3d(0, -10px, 5px) rotateX(-5deg);
    }

    25% {
        transform: translate3d(0, -10px, -5px) rotateX(5deg);
    }

    30% {
        transform: translate3d(0, 0, 0) rotateX(0);
    }
}

.lid-top,
.lid-left,
.lid-back,
.lid-right,
.lid-front {
    background-color: #fff; ฝากล่อง
    border: 1px solid rgba(0, 0, 0, .2);
    left: -5px;
    opacity: 1;
    position: absolute;
    top: 0;
    width: 250px;
}

.lid-top {
    height: 250px;
    top: -5px;
    transform: translateY(-50%) rotateX(90deg);
    transform-style: preserve-3d;
}

.lid-left,
.lid-back,
.lid-right,
.lid-front {
    height: 40px;
    top: -5px;
    transform-style: preserve-3d;
}

.lid-left {
    transform: translateX(-50%) rotateY(-90deg);
}

.lid-back {
    transform: translateZ(-125px) rotateY(180deg);
}

.lid-right {
    transform: translateX(50%) rotateY(90deg);
}

.lid-front {
    transform: translateZ(125px);
}

.present:hover .lid {
    animation: none;
    transform: translate3d(0, -40px, -10px) rotateX(10deg);
}

.present.open .name {
    transform: translate3d(0, -50%, 10px) rotateY(1080deg) rotateX(10deg);

}

.present.open .instruction {
    opacity: 0;
}

.present.open .left {
    transform: translateX(-50%) rotateY(-90deg) rotateX(-90deg);
}

.present.open .back {
    transform: translateZ(-120px) rotateY(180deg) rotateX(-90deg);
}

.present.open .right {
    transform: translateX(50%) rotateY(90deg) rotateX(-90deg);
}

.present.open .front {
    transform: translateZ(120px) rotateX(-90deg);
}

.present.open .lid {
    animation: none;
    transform: translate3d(0, -120px, -120px) rotateX(50deg);
}

footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 2.5rem;
    /* Footer height */
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
</html>
