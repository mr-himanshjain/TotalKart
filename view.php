<?php include ('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
// $sql = "SELECT * FROM products WHERE ID={$id}";
$sql = "SELECT p.*, pi.image_path 
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.id ={$id}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (
            $row['type'] == 'television' || $row['type'] == 'shoes' || $row['type'] == 'dining set' || $row['type'] == 'laptops' || $row['type'] == 'sofas and sofa sets'
        ) { ?>
            <div style="height:250px; width:300px;">
                <img src="<?php echo $row['image_path']; ?>" alt="" height="110%" width="150%">
            </div>
        <?php } else { ?>
            <div style="height:250px; width:300px;">
                <img src="<?php echo $row['image_path']; ?>" alt="" height="100%" width="70%" style="margin-left:50px">
            </div>
            <?php
        }
    }
} else {
    echo "no data found";
}
?>