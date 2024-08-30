<?php include ('config.php'); ?>
<div class="section2 row p-3">
    <?php
    $sql = "SELECT p.*, pi.image_path 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE p.category = 'laptops'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            if (strlen($name) > 20) {
                $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            echo '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12 card my-1 px-0" style=" width: 200px; height: 250px; overflow:auto; border:0px; border-radius:8px; background-color: transparent;display:flex; align-items:center;">' .
                '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                '<div style="width: 190px; height: 160px; display: flex; justify-content: center; align-items: center; border:1px solid #dddddd; border-radius:8px; background-color:white; box-shadow: 0px 12px 10px 0px #ebebeb; overflow:hidden;">' .
                '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain; padding:2px; background-color:white; "/>' .
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
    }
    ?>
</div>
<div class="section2 row p-3">
    <?php
    $sql = "SELECT p.*, pi.image_path 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE p.category = 'mobile'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            if (strlen($name) > 20) {
                $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            if (strlen($name) > 20) {
                $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            echo '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12 card my-1 px-0" style=" width: 200px; height: 250px; overflow:auto; border:0px; border-radius:8px; background-color: transparent; display:flex; align-items:center;">' .
                '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                '<div style="width: 190px; height: 160px; display: flex; justify-content: center; align-items: center; border:1px solid #dddddd; border-radius:8px; background-color:white; box-shadow: 0px 12px 10px 0px #ebebeb; overflow:hidden;">' .
                '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain; padding:2px; background-color:white;"/>' .
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
    }
    ?>
</div>
<div class="section2 row p-3">
    <?php
    $sql = "SELECT p.*, pi.image_path 
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.category = 'watches'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            if (strlen($name) > 20) {
                $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            if (strlen($name) > 20) {
                $name = substr($name, 0, 15) . '...'; // Truncate the string to 30 characters and add ellipsis
            }
            echo '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12 card my-1 px-0" style=" width: 200px; height: 250px; overflow:auto; border:0px; border-radius:8px; background-color: transparent; display:flex; align-items:center;">' .
                '<a style="color: gray; text-decoration: none;" href="productView.php?id=' . $row['id'] . '">' .
                '<div style="width: 190px; height: 160px; display: flex; justify-content: center; align-items: center; border:1px solid #dddddd; border-radius:8px; background-color:white; box-shadow: 0px 12px 10px 0px #ebebeb; overflow:hidden;">' .
                '<img src="' . $row['image_path'] . '" class="card-img-top" alt="Wild Landscape" style="max-width: 100%; max-height: 100%; object-fit: contain; padding:2px; background-color:white; "/>' .
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
    }
    ?>
</div>