<?php
require 'config.php';
session_start();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$category = $_GET['category'];
$subCategory = $_GET['subCategory'];
if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $decoded = JWT::decode($token, new key($key, 'HS256'));
    $user_id = $decoded->sub->id;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category : <?php echo $category; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .productDetails {
            font-family: system-ui;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php
    include ("indexNav.php");
    ?>
    <div class="container py-4">
        <div style="display:flex; flex-wrap: wrap;">
            <?php
            $sql = "SELECT p.*, pi.image_path 
                FROM products p 
                LEFT JOIN product_images pi ON p.id = pi.product_id 
                WHERE p.category = '$category' AND p.subCategory = '$subCategory'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="container-fluid" style="padding-right:0px; padding-left:0px;">
                        <div class="container productViewmain">
                            <div class="row p-3 viewAndDetail">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    $sql = "SELECT p.*, pi.image_path FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.id =" . $row['id'] . "";
                                    $result1 = $conn->query($sql);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (
                                                $row1['category'] == 'television' || $row1['category'] == 'shoes' || $row1['category'] == 'dining set' || $row1['category'] == 'laptops' || $row1['category'] == 'sofas and sofa sets'
                                            ) { ?>
                                                <div style="height:250px; width:300px; margin:auto;">
                                                    <img src="<?php echo $row1['image_path']; ?>" alt="" height="90%" width="100%">
                                                </div>
                                            <?php } else { ?>
                                                <div style="height:250px; width:200px; margin:auto;">
                                                    <img src="<?php echo $row1['image_path']; ?>" alt="" height="90%" width="100%">
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    $sql = "SELECT * FROM products WHERE id =" . $row['id'] . "";
                                    $result2 = $conn->query($sql);
                                    if ($result2->num_rows > 0) {
                                        while ($row2 = $result2->fetch_assoc()) {
                                            echo '<div class="productDetails">' .
                                                '<p><b>' . $row2['name'] . '</b></p>' .
                                                '<p style="font-size:16px;">' . $row2['description'] . '</p>' .
                                                '<p>' . $row2['price'] . '</p>' .
                                                '<p>' . $row2['category'] . '</p>' .
                                                '<p>' . $row2['type'] . '</p>' .
                                                '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user']['priority'] == 0) {
                                ?>
                                <!-- <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                        href="addtocart.php?user_id=<?php echo $user_id ?>&Product_id=<?php echo $row['id'] ?>">Add
                                        To
                                        Cart</a></button> -->
                                <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                        href="buyNow.php?user_id=<?php echo $user_id ?>&Product_id=<?php echo $row['id'] ?>">Buy
                                        Now</a></button>
                                <?php
                            } else /*if (empty($_COOKIE['token'])) */ { ?>
                                <p>
                                    <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                            href="login.php?Product_id=<?php echo $row['id'] ?>">Add To
                                            Cart</a></button>
                                    <button class="btn btn-warning"><a class="text-decoration-none text-white "
                                            href="login.php?Product_id=<?php echo $row['id'] ?>">Buy Now</a></button>
                                </p>
                            <?php } ?>
                            <hr>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
            }
            ?>
        </div>
    </div>
    <?php
    include ("indexFooter.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>