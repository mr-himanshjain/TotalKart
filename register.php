<?php
require 'config.php';

$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $error = 'Enter a email address';
    } else if (empty($_POST['password'])) {
        $error = 'Please Enter a password';
    } else if (empty($_POST['name'])) {
        $error = 'Please Enter a name';
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO user (name, email,password) VALUES('$name','$email','$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('location: index.php');
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
    <title>Register</title>
</head>

<body>
    <?php
    include ("indexNav.php");
    ?>
    <div class="container"
        style="display: flex; justify-content: center; align-content: center; align-items: center; flex-wrap: wrap; margin-top:100px;">
        <form method="post">
            <?php
            if ($error !== '') {
                echo '<div style="background-color:rgba(255,0,0,0.7);"><p style="color:rgba(255,255,0,1); padding:13px; text-align:center">' . $error . '</p></div>';
            }
            ?>
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address*</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                    required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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