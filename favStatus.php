<?php
// Assuming $conn is your database connection

// Sanitize the input to prevent SQL injection
$id = intval($_GET['id']); // Assuming the ID is passed via GET

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['like'])) {
        $sql = "UPDATE products SET LikeCount = 1 WHERE id = ?";
    } elseif (isset($_POST['dislike'])) {
        $sql = "UPDATE products SET LikeCount = 0 WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Return the updated like status to the JavaScript function
    echo json_encode(['status' => 'success']);
    exit;
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $likeStatus = $row['LikeCount'] == 1 ? 'none' : '';
    $dislikeStatus = $row['LikeCount'] == 0 ? 'none' : '';

    ?>
    <div class="like" id="likeDiv" style="display:<?php echo $likeStatus ?>">
        <button type="button" onclick="like(<?php echo $id ?>)" style="border:0px; background-color:white;">
            <img height="40px" width="40px" src="dislike.png" alt="">
            &nbsp;&nbsp;Add to favorites
        </button>
    </div>
    <div class="dislike" id="dislikeDiv" style="display:<?php echo $dislikeStatus ?>">
        <button type="button" onclick="dislike(<?php echo $id ?>)" style="border:0px; background-color:white;">
            <img height="40px" width="40px" src="like.png" alt="">
            &nbsp;&nbsp; Remove from favorites
        </button>
    </div>
    <?php
}
?>
<script>
    function like(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    document.getElementById('likeDiv').style.display = 'none';
                    document.getElementById('dislikeDiv').style.display = '';
                }
            }
        };
        xhttp.open("POST", "", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("like=1&id=" + id);
        location.reload();
    }

    function dislike(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    document.getElementById('likeDiv').style.display = '';
                    document.getElementById('dislikeDiv').style.display = 'none';
                }
            }
        };
        xhttp.open("POST", "", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dislike=1&id=" + id);
        location.reload();
    }
</script>