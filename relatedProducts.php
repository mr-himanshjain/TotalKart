<?php include ('config.php'); ?>
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
                if (strlen($name) > 30) {
                    $name = substr($name, 0, 30) . '...'; // Truncate the string to 30 characters and add ellipsis
                }
                echo '<div class="col-lg-3 col-md-6 col-sm-12 card my-1" style="width: 300px; height: 360px; overflow:auto">' .
                    '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                    '<div style="width: 100%; padding-top:10px; height: 200px; display: flex; justify-content: center; align-items: center;">' .
                    '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain;"/>' .
                    '</div>' .
                    '<div class="card-body">' .
                    '<h5 class="card-title">' . $name . '</h5>' .
                    '<p class="card-text">' . $row['type'] . '</p>' .
                    '</div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">Price: ' . $row['price'] . '</li>' .
                    '</ul></a>' .
                    '</div> ';
            }
        } else {
            echo "No data found for ID: $id<br>";
        }
    }
}

?>