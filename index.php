<!DOCTYPE html>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/log.php"); ?>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://xiuxiu-1306082599.cos.ap-beijing.myqcloud.com/images/images/xiaologo.png" />
    <title>图片</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url(<?php echo $url; ?>);
            background-size: cover;
        }

        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(30px);
        }

        .img-show {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 960px;
            height: 540px;
            border: 2px solid #bebebe;
            border-radius: 15px;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, .3), -8px -8px 20px rgba(0, 0, 0, .3);
            background: url(<?php echo $url; ?>);
            background-size: cover;
        }

        .img-show .img-large {
            display: none;
            position: absolute;
            width: 250px;
            height: 250px;
            border: 2px solid #bebebe;
            border-radius: 125px;
            overflow: hidden;
            background-color: #fff;
        }

        .img-show .img-large::after {
            content: "+";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: #3e3e3e;
            font-size: 30px;
        }

        .img-show .img-large:hover {
            cursor: none;
        }

        .img-show .img-large img {
            position: absolute;
            width: 1920px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="img-show">
        <div class="img-large">
            <img src="<?php echo $url; ?>" alt="">
        </div>
    </div>
    <script>
        let imgShow = document.querySelector('.img-show');
        let imgLarge = document.querySelector('.img-large');
        let img = document.querySelector('img');
        imgShow.addEventListener('mouseover', function() {
            imgLarge.style.display = "block";
        });
        imgShow.addEventListener('mousemove', function(event) {
            let x = event.pageX - this.offsetLeft;
            let y = event.pageY - this.offsetTop;
            imgLarge.style.left = (x + 480 - 125) + 'px';
            imgLarge.style.top = (y + 270 - 125) + 'px';
            if (x < -480 || x > 480 || y < -270 || y > 270) {
                imgLarge.style.display = "none";
            }
            img.style.left = (-(x + 480) * 2 + 125) + 'px';
            img.style.top = (-(y + 270) * 2 + 125) + 'px';
        });
    </script>
</body>

</html>