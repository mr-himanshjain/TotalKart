<?php
include ('config.php');

// Retrieve user_id and Product_id from the URL parameters
date_default_timezone_set('Asia/Kolkata');
$user_id = $_GET['user_id'];
$product_id = $_GET['Product_id'];
$date = date('Y-n-d H:i:s');
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $sql = "INSERT INTO orders (user_id, product_id, quantity,order_date) VALUES ('$user_id', '$product_id', '$quantity','$date')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href=".././assest/css/style.css">
    <style>
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

        #productQuantity {
            width: 70px;
            height: 40px;
            border-radius: 10px;
            border: 0px solid lightgray;
            box-shadow: -1px -1px 5px 2px lightgray;
            font-size: 20px;
            text-align: center;
        }

        #main-div {
            padding-right: 0px;
            padding-left: 0px;
            display: block;
        }

        #submit {
            background-color: orange;
            color: white;
            border-radius: 20px;
            font-size: 23px;
        }
    </style>
</head>

<body>
    <?php include ("indexNav.php"); ?>
    <div id="payment-gif" style="display:none;">
        <dotlottie-player src="https://lottie.host/4d7b346b-ed43-4e47-a3e3-fcfd911e53bd/n75LRq9aPN.json"
            background="transparent" speed="1" style="width: 100vw; height: 80vh;" loop autoplay></dotlottie-player>
    </div>
    <div class="container-fluid" id="main-div">
        <div class="container productViewmain">
            <div class="row my-5 p-5 viewAndDetail">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php include "view.php"; ?>
                    <?php include "details.php"; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <form id="order-form">
                        <h3>Product Quantity:<span>&nbsp;&nbsp;&nbsp;<input type="number" min="1" max="10"
                                    name="quantity" id="productQuantity"></span>
                        </h3>
                        <input type="submit" class="my-5 p-2 border-0" name="submit" id="submit"
                            value="Proceed to Payment">
                    </form>
                </div>
            </div>
            <hr>
            <h3>Related Products <br></h3>
            <div class="row justify-content-around">
                <?php include "relatedProducts.php"; ?>
            </div>
        </div>
        <?php include "indexFooter.php"; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#order-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission
                $('#payment-gif').show(); // Show the payment GIF
                $('#main-div').hide();

                // Perform the AJAX request
                $.ajax({
                    type: 'POST',
                    url: '', // Same page
                    data: $(this).serialize() + '&ajax=true', // Add an indicator for AJAX request
                    success: function (response) {
                        setTimeout(function () {
                            $('#payment-gif').hide();
                            $('#main-div').show();
                            window.location.href = 'index.php'; // Redirect after 3 seconds
                        }, 3000);
                    },
                    error: function () {
                        alert('An error occurred while processing your request.');
                        $('#payment-gif').hide();
                    }
                });
            });
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