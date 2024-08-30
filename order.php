<?php
require 'config.php';
$user_id = $_GET['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        span {
            font-size: 16px;
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
            $sql = "SELECT
                        o.user_id,
                        o.product_id,
                        o.quantity,
                        o.order_date,
                        p.*,
                        pi.image_path
                    FROM
                        orders o
                    JOIN
                        products p ON o.product_id = p.id
                    JOIN
                        product_images pi ON o.product_id = pi.id
                    WHERE
                        o.user_id = $user_id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // print_r($row);
                    // die;
                    $dateString = $row['order_date'];
                    $timestamp = strtotime($dateString);
                    $formattedDate = date('l, F j, Y g:i A', $timestamp);
                    ?>
                    <div class="container-fluid" style="padding-right:0px; padding-left:0px; background-color: #f9f9f9;">
                        <div class="container productViewmain">
                            <div class="row my-1 p-1 viewAndDetail">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    if (
                                        $row['category'] == 'television' || $row['category'] == 'shoes' || $row['category'] == 'dining set' || $row['category'] == 'laptops' || $row['category'] == 'sofas and sofa sets'
                                    ) { ?>
                                        <div style="height:250px; width:300px; margin:auto;">
                                            <img src="<?php echo $row['image_path']; ?>" alt="" height="100%" width="150%">
                                        </div>
                                    <?php } else { ?>
                                        <div style="height:250px; width:300px; margin:auto;">
                                            <img src="<?php echo $row['image_path']; ?>" alt="" height="100%" width="70%"
                                                style="margin-left:50px">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    echo '<div class="productDetails" style="font-family: system-ui; font-size: 20px;">' .
                                        '<p><b>' . $row['name'] . '</b></p>' .
                                        '<p style="font-size:16px;">' . $row['description'] . '</p>' .
                                        '<p><span>Price:</span><b>   ₹ ' . $row['price'] . '</b></p>' .
                                        '<p><span>Category:</span><b>    ' . $row['category'] . '</b></p>' .
                                        '<p><span>Type:</span><b>    ' . $row['type'] . '</b></p>' .
                                        '<p><span>Quantity:</span><b>    ' . $row['quantity'] . '</b></p>' .
                                        '<p><span>Total Amount:</span><b>   ₹ ' . $row['price'] * $row['quantity'] . '</b></p><br>' .
                                        '<p><span>Order Date:</span><b>    ' . $formattedDate . '</b></p>' .
                                        '</div>';
                                    ?>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
            } else {
                echo "<h1 style='font-weight:900; margin:auto'>No data found</h1>";
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