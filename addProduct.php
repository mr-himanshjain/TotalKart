<?php include ('config.php');
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalKart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    include ("indexNav.php");
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Insert product into products table
        $pname = $_POST['pname'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $type = $_POST['type'];

        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, type) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $pname, $description, $price, $category, $type);
        $stmt->execute();
        $productId = $stmt->insert_id; // Get the ID of the newly inserted product
        $stmt->close();

        // Insert product image into product_images table
        $target_dir = "uploads/";
        if (isset($_FILES["productimage"]) && $_FILES["productimage"] !== null) {
            foreach ($_FILES["productimage"] as $key => $tmp_name) {
                $factory = (new Factory)
                    ->withServiceAccount('./impdoc/personal-datastorage-firebase-adminsdk-d9141-d9227e3e5c.json')
                    ->withDatabaseUri('https://console.firebase.google.com/u/0/project/personal-datastorage/storage/personal-datastorage.appspot.com/files');
                $storage = $factory->createStorage();
                $storageClient = $storage->getStorageClient();
                $defaultBucket = $storage->getBucket();

                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($_FILES["productimage"]["name"], PATHINFO_EXTENSION));
                $imagePath = $_FILES["productimage"]["name"];
                $target_file = $target_dir . $imagePath;
                // Check if the file is an actual image
                $check = getimagesize($_FILES["productimage"]["tmp_name"]);
                if ($check === false) {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["productimage"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow only certain file formats (you can adjust this list)
                $allowedFormats = array("jpg", "jpeg", "png", "gif");
                if (!in_array($imageFileType, $allowedFormats)) {
                    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $target_file)) {
                        $destinationPath = basename($imagePath);
                        // Upload the image file to Firebase Storage
                        $defaultBucket->upload(file_get_contents($target_file), [
                            'name' => $destinationPath,
                        ]);
                        // Once uploaded, you can retrieve the access token (download URL) for the uploaded image
                        $file = $defaultBucket->object($destinationPath);
                        $expirationDate = new DateTime();
                        $expirationDate->add(new DateInterval('P10Y'));
                        $downloadUrl = $file->signedUrl($expirationDate);
                        // Insert image info into product_images table
                        $stmt = $conn->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?,?)");
                        $stmt->bind_param("ss", $productId, $downloadUrl);
                        $stmt->execute();
                        $stmt->close();
                        echo "Product and image information added successfully.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
            $conn->close();
        }
    }

    ?>
    <div class="container-fluid" style="padding-right:0px; padding-left:0px;">
        <div class="container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                enctype="multipart/form-data">
                <div class="form-group mt-5">
                    <label for="pname">Product Name</label>
                    <input type="text" class="form-control" name="pname" id="pname">
                </div>
                <div class="form-group my-3">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description">
                </div>
                <div class="form-group my-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
                <div class="form-group my-3">
                    <label for="category">Category</label>
                    <?php
                    $sql = "SELECT DISTINCT category FROM products";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        echo '<select name="category" id="category" class="form-control">';
                        echo '<option value="">Select</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <div class="form-group my-3">
                    <label for="type">Type</label>
                    <?php
                    $sql = "SELECT DISTINCT type FROM products";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        echo '<select name="category" id="category" class="form-control">';
                        echo '<option value="">Select</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <label for="productimage">Product Image</label><br>
                <div class="form-group my-2 d-flex justify-content-between">
                    <input type="file" class="form-control-file" name="productimage" id="productimage">
                    <button type="submit" class="btn btn-success my-2 px-4">Add Product</button>
                </div>
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