<?php
include 'config.php';
$query = $_GET['searchQuery'];

// Prepare the SQL query with a wildcard for partial matching
$sql = "SELECT id, name FROM products WHERE name LIKE '$query%'";

// Execute the query
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}

// Initialize an array to store the results
$resultsArray = array();
$resultsArray = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each row to the results array
        $resultsArray[] = $row;
    }
    // Encode the array as JSON and send it as the response
    echo json_encode($resultsArray);
} else {
    echo json_encode([]);
}

$conn->close();
?>