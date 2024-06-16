<?php include ('config.php');
session_start();

$hideDivs = '';
$hidesecondDivs = 'none';

// Check if this is an AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['screenWidth'])) {
    $screenWidth = intval($_POST['screenWidth']);

    if ($screenWidth <= 575) {
        $hideDivs = 'none';
        $hidesecondDivs = '';
    }

    // Return the response as JSON
    echo json_encode(
        array(
            'hideDivs' => $hideDivs,
            'hidesecondDivs' => $hidesecondDivs
        )
    );
    exit; // Exit to prevent the rest of the HTML from being sent
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function updateScreenWidth() {
                var screenWidth = $(window).width();
                console.log(screenWidth);
                $.ajax({
                    url: '', // Empty URL to send the request to the same file
                    type: 'POST',
                    data: { screenWidth: screenWidth },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $('.index-div-card').css('display', data.hideDivs);
                        $('.small-screen-index-div').css('display', data.hidesecondDivs);
                    }
                });
            }
            if ($(window).width() <= 768) {
                $('.firstcontainer').removeClass('container');
            } else {
                $('.firstcontainer').addClass('container');
            }

            // Update on page load
            updateScreenWidth();

            // Update on window resize
            $(window).resize(function () {
                updateScreenWidth();
            });
        });
    </script>
</head>

<body>
    <?php
    include ("indexNav.php");
    ?>
    <div class="container-fluid" style="padding-right:0px; padding-left:0px;">
        <div class="firstcontainer container">
            <?php
            include "indexBody.php";
            ?>
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
        <script>
            function setScreenWidthCookie() {
                document.cookie = "screenWidth=" + window.innerWidth + "; path=/";
            }
            window.onload = setScreenWidthCookie;
            window.onresize = setScreenWidthCookie;
        </script>


</body>

</html>