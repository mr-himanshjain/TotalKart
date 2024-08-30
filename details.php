<?php include ('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['Product_id'])) {
    $id = $_GET['Product_id'];
}
$url = '/totalkart/buyNow.php';
// $url = '/buyNow.php';
$sql = "SELECT p.*, pi.image_path 
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.id ={$id}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['LikeCount'] == 1) {
            $likeStatus = '';
            $dislikeStatus = 'none';
        } else {
            $likeStatus = 'none';
            $dislikeStatus = '';
        }
        echo '<div class="productDetails" style="font-family: system-ui; font-size: 20px;">' .
            '<p><b>' . $row['name'] . '</b></p>' .
            '<p style="font-size:16px; margin-bottom:38px;">' . $row['description'] . '</p>' .
            '<div style="line-height:14px;"><p style="font-weight:bold;">₹ ' . $row['price'] . '</p>' .
            '<p style="color:#afafaf;">' . $row['category'] . '</p>' .
            '<p>' . $row['type'] . '</p>' .
            '</div></div>';
        if ($_SERVER['PHP_SELF'] !== $url) {
            include 'favStatus.php';
        }
    }
} else {
    echo "no data found";
}
?>