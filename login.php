<?php
require 'config.php';

require 'vendor\autoload.php';
use Firebase\JWT\JWT;

$error = '';

if (isset($_POST['login'])) {
    if (empty($_POST['email'])) {
        $error = 'Enter a email address';
    } else if (empty($_POST['password'])) {
        $error = 'Enter a password address';
    } else {
        $email = $_POST['email'];
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['password'] === $_POST['password']) {
                    $key = 'azwxsedcrfvtgbynhumjizawxsecdrvftgbnyhjumikuigfvbczawxsecdrvftgybnhumjiuiefgvbwyvgbsdvwydtvbcwgjbuic';
                    $payload['id'] = $row['id'];
                    $payload = [
                        'sub' => $payload,
                        'exp' => time() + 3600,
                    ];
                    $token = JWT::encode($payload, $key, 'HS256');
                    setcookie("token", $token, time() + 3600, "/", "", true, true);
                    if (isset($_GET['Product_id'])) {
                        $product_id = $_GET['Product_id'];
                        header('Location: buyNow.php?user_id=' . urlencode($row['id']) . '&Product_id=' . urlencode($product_id));
                        exit;
                    }
                    header('location: index.php');
                } else {
                    $error = 'Wrong Password!';
                }
            }
        } else {
            $error = 'Wrong Email address';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary ">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">Totalkart</a>
            <a class="navbar-brand text-white" href="register.php">SignIn</a>
        </div>
    </nav>
    <div class="container" style="margin-top:9%; margin-bottom:8.5%;">
        <form method="post">
            <?php
            if ($error !== '') {
                echo '<div style="background-color:rgba(255,0,0,0.7);"><p style="color:rgba(255,255,0,1); padding:13px; text-align:center">' . $error . '</p></div>';
            }
            ?>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    include ("indexFooter.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>