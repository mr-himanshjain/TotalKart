<?php include('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['Product_id'])) {
    $id = $_GET['Product_id'];
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
            $row['category'] == 'television' || $row['category'] == 'shoes' || $row['category'] == 'dining set' || $row['category'] == 'laptops' || $row['category'] == 'sofas and sofa sets'
        ) { ?>
            <div id="content" style="height:250px; width:fit-content; margin:auto;">
                <img id="thumbnail" class="clickable-image" src="<?php echo $row['image_path']; ?>" alt="" height="90%"
                    width="100%">
            </div>
            <div id="popup" class="popup hidden">
                <span id="close-popup" class="close-popup">&times;</span>
                <img id="popup-image" src="<?php echo $row['image_path']; ?>" alt="Full Size Image">
            </div>

        <?php } elseif ($row['category'] == 'watches' || $row['category'] == 'power banks') { ?>
            <div id="content" style="height:250px; width:fit-content; margin:auto;">
                <img id="thumbnail" class="clickable-image" src="<?php echo $row['image_path']; ?>" alt="" height="90%"
                    width="100%">
            </div>
            <div id="popup" class="popup hidden">
                <span id="close-popup" class="close-popup">&times;</span>
                <img id="popup-image" src="<?php echo $row['image_path']; ?>" alt="Full Size Image">
            </div>

            <?php
        } else { ?>
            <div id="content" style="height:250px; width:200px; margin:auto;">
                <img id="thumbnail" class="clickable-image" src="<?php echo $row['image_path']; ?>" alt="" height="90%"
                    width="100%">
            </div>
            <div id="popup" class="popup hidden">
                <span id="close-popup" class="close-popup">&times;</span>
                <img id="popup-image" src="<?php echo $row['image_path']; ?>" alt="Full Size Image">
            </div>

            <?php
        }
    }
} else {
    echo "no data found";
}
?>