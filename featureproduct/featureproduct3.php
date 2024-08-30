<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$ids = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['category'] !== 'furniture & mattresses') {
            $ids[] = $row["id"];
        }
    }
    $randomIds = array();
    for ($i = 0; $i < 5; $i++) {
        $randomIndex = mt_rand(0, count($ids) - 1);
        $randomId = $ids[$randomIndex];
        if (!in_array($randomId, $randomIds)) {
            $randomIds[] = $randomId;
        }
    }
    echo '<div class="d-flex justify-content-between" style="flex-wrap: nowrap; overflow-x: auto;">';
    foreach ($randomIds as $id) {
        $sql = "SELECT p.*, pi.image_path 
                FROM products p 
                LEFT JOIN product_images pi ON p.id = pi.product_id 
                WHERE p.id ={$id}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $type = $row['type'];
                if ($type == 'mattress' || $type == 'sofas and sofa sets' || $type == 'dining set') {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 card border-0" style="width: 50%; overflow:auto">' .
                        '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                        '<div class="featureProductCard">' .
                        '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: cover;"/>' .
                        '</div></a>' .
                        '</div> ';
                } else if ($type == 'shoes' || $type == 'television' || $type == 'headphone / earphone' || $type == 'mobile' || $type == 'watches' || $type == 'laptops') {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 card border-0" style="width: 50%; overflow:auto">' .
                        '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                        '<div style="width: 100%; padding-top:10px; height: 150px; display: flex; justify-content: center; align-items: center; display:flex; justify-content:center"">' .
                        '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain;"/>' .
                        '</div></a>' .
                        '</div> ';
                } else {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 card border-0" style="width: 50%; overflow:auto">' .
                        '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                        '<div style="width: 100%; padding-top:10px; height: 150px; display: flex; justify-content: center; align-items: center; display:flex; justify-content:center"">' .
                        '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain;"/>' .
                        '</div></a>' .
                        '</div> ';

                }
            }
        } else {
            echo "No data found for ID: $id<br>";
        }
    }
    echo '</div>';
}
?>