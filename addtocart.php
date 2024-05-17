<?php
// Retrieve user_id and Product_id from the URL parameters
$user_id = $_GET['user_id'];
$product_id = $_GET['Product_id'];
print_r($user_id);
print_r($product_id);

// Now you can use these variables to run your query or perform any other actions
// For example:
// $sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
// Execute your SQL query here
?>