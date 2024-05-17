<?php include ('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$sql = "SELECT p.*, pi.image_path 
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.id ={$id}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="productDetails" style="font-family: system-ui; font-size: 20px;">' .
            '<p><b>' . $row['name'] . '</b></p>' .
            '<p>' . $row['description'] . '</p>' .
            '<p>' . $row['price'] . '</p>' .
            '<p>' . $row['category'] . '</p>' .
            '<p>' . $row['type'] . '</p>' .
            '</div>';
    }
} else {
    echo "no data found";
}
?>