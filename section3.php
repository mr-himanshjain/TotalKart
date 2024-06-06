<?php include ('config.php'); ?>
<div class="section3 row p-3">
    <?php
    $sql = "SELECT p.*, pi.image_path 
    FROM products p 
    LEFT JOIN product_images pi ON p.id = pi.product_id 
    WHERE p.category = 'watches'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            if (strlen($name) > 30) {
                $name = substr($name, 0, 30) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            echo '<div class="col-lg-3 col-md-6 col-sm-12 card border-0 my-1" style="width: 300px; height: 360px; overflow:auto">' .
                '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                '<div style="width: 100%; padding-top:10px; height: 200px; display: flex; justify-content: center; align-items: center;">' .
                '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain;"/>' .
                '</div>' .
                '<div class="card-body">' .
                '<h5 class="card-title">' . $name . '</h5>' .
                '<p class="card-text">' . $row['category'] . '</p>' .
                '</div>' .
                '<ul class="list-group list-group-flush">' .
                '<li class="list-group-item">Price: ' . $row['price'] . '</li>' .
                '</ul></a>' .
                '</div> ';
        }
    }
    ?>
</div>