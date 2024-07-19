<?php
include "config.php";
session_start();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $decoded = JWT::decode($token, new key($key, 'HS256'));
    $user_id = $decoded->sub->id;
}
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalKart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href=".././assest/css/style.css">
    <style>
        .row {
            --bs-gutter-x: 0rem;
        }

        #content {
            padding: 20px;
            text-align: center;
        }

        .clickable-image {
            cursor: pointer;
            max-width: 100%;
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup.hidden {
            display: none;
        }

        .popup img {
            max-width: 90%;
            max-height: 90%;
        }

        .close-popup {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            color: #fff;
            cursor: pointer;
        }

        .blur {
            filter: blur(5px);
        }
    </style>

</head>

<body>
    <?php
    include ("indexNav.php");
    ?>
    <div class="container-fluid" style="padding-right:0px; padding-left:0px;">
        <div class="container productViewmain">
            <div class="row my-5 p-3 viewAndDetail">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php include "view.php"; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php include "details.php"; ?>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user']['priority'] == 0) {
                ?>
                <!-- <button class="btn btn-warning"><a class="text-decoration-none text-white "
                        href="addtocart.php?user_id=<?php echo $user_id ?>&Product_id=<?php echo $product_id ?>">Add To
                        Cart</a></button> -->
                <button class="btn btn-warning"><a class="text-decoration-none text-white "
                        href="buyNow.php?user_id=<?php echo $user_id ?>&Product_id=<?php echo $product_id ?>">Buy
                        Now</a></button>
                <?php
            } else if (empty($_COOKIE['token'])) { ?>
                    <p>
                        <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                href="login.php?Product_id=<?php echo $product_id ?>">Add To
                                Cart</a></button>
                        <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                href="login.php?Product_id=<?php echo $product_id ?>">Buy Now</a></button>
                    </p>
            <?php }
            ?>
            <hr>
            <h3>Related Products <br></h3>
            <div class="row justify-content-around">
                <?php include "relatedProducts.php"; ?>
            </div>
        </div>
        <?php
        include "indexFooter.php";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const thumbnail = document.getElementById('thumbnail');
            const popup = document.getElementById('popup');
            const popupImage = document.getElementById('popup-image');
            const closePopup = document.getElementById('close-popup');
            const content = document.getElementById('content');

            thumbnail.addEventListener('click', function () {
                popup.classList.remove('hidden');
                content.classList.add('blur');
            });

            closePopup.addEventListener('click', function () {
                popup.classList.add('hidden');
                content.classList.remove('blur');
            });

            popup.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.classList.add('hidden');
                    content.classList.remove('blur');
                }
            });
        });
    </script>
</body>

</html>