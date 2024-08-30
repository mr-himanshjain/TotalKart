<?php include('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['Product_id'])) {
    $id = $_GET['Product_id'];
}
$sql = "SELECT category FROM products where id={$id}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = $row['category'];
    }
}

$sql = "SELECT id FROM products where category='{$category}'";
$result = $conn->query($sql);
$ids = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ids[] = $row["id"];
    }
    $randomIds = array();
    for ($i = 0; $i < 4; $i++) {
        $randomIndex = mt_rand(0, count($ids) - 1);
        $randomId = $ids[$randomIndex];
        if (!in_array($randomId, $randomIds)) {
            $randomIds[] = $randomId;
        }
    }
    foreach ($randomIds as $id) {
        // $sql = "SELECT * FROM products WHERE id = $id";
        $sql = "SELECT p.*, pi.image_path 
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.id ={$id}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                if (strlen($name) > 20) {
                    $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
                }
                echo '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12 card my-1 px-0" style=" width: 200px; height: 250px; overflow:auto; border:0px; border-radius:8px; background-color: transparent;">' .
                    '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                    '<div style="width: 190px; height: 160px; display: flex; justify-content: center; align-items: center; border:1px solid #dddddd; border-radius:8px; box-shadow: 0px 12px 10px 0px #ebebeb;">' .
                    '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius:12px; padding:2px;"/>' .
                    '</div>' .
                    '<div class="card-body" style="padding:10px 16px 0px 16px;">' .
                    '<h5 class="card-title" style="font-size:16px; margin-bottom:1px">' . $name . '</h5>' .
                    '<p class="card-text" style="font-size:10px;">' . $row['category'] . '</p>' .
                    '</div>' .
                    '<div class="card-body" style="padding:10px 16px 0px 16px">' .
                    '<p class="card-text" style="font-size:16px;">Price: ₹ ' . $row['price'] . '</p>' .
                    '</div>' .
                    '</a>' .
                    '</div> ';
            }
        } else {
            echo "No data found for ID: $id<br>";
        }
    }
}

?>