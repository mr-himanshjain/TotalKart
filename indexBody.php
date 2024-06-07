<?php
include "slider.php";
?>
<div class="d-flex justify-content-evenly my-3">
    <div class="col-7 profile-section usersection">
        <?php if (empty($_COOKIE['token'])) { ?>
            <p class="py-5 text-xl-center " style="font-size:25px; font-weight:500; color:#7c7c7c">
                Welcome! Enjoy seamless shopping and exclusive deals. Sign up for a personalized experience!
            </p>
            <div class="d-flex justify-content-evenly action-button">
                <a href="login.php"><input type="button" class="btn btn-primary text-white" value="Login"></a>
                <a href="register.php"><input type="button" class="btn btn-light" value="Sign up"></a>
            </div>
        <?php } else { ?>
            <div class="d-flex user-details">
                <div class="profile-img col-4">
                    <img src="./img/avatar.png" alt="profile-img" width="100%" height="100%" style="border-radius:100%">
                </div>
                <div class="user-name col-8">
                    <p>Hii..! </p>
                    <p><?php echo $_SESSION['user']['name']; ?></p>
                </div>
            </div>
            <div class="row user-action">
                <div class="col-6 d-flex justify-content-around">
                    <a href="profile.php"><input type="button" class="btn btn-light" value="Account"></a>
                </div>
                <div class="col-6 d-flex justify-content-around">
                    <a href="order.php"><input type="button" class="btn btn-light" value="Your Order"></a>
                </div>
                <div class="col-6 d-flex justify-content-around">
                    <a href="wishlist.php"><input type="button" class="btn btn-light" value="Your List"></a>
                </div>
                <div class="col-6 d-flex justify-content-around">
                    <a href="favorites.php"><input type="button" class="btn btn-light" value="Favorites"></a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-4 usersection">
        <?php require './featureproduct/featureproduct1.php'; ?>
    </div>
</div>
<div class="d-flex justify-content-evenly my-3">
    <div class="col-4 usersection">
        <?php require './featureproduct/featureproduct2.php'; ?>
    </div>
    <div class="col-7 usersection">
        offer
    </div>
</div>
<div class="d-flex justify-content-evenly my-3">
    <div class="col-7 usersection">
        <?php require './featureproduct/featureproduct3.php'; ?>
    </div>
    <div class="col-4 usersection">
        <?php require './featureproduct/featureproduct4.php'; ?>
    </div>
</div>

<div class="firstCard container">
    <div class="contentbody">
        <?php
        include "section1.php";
        ?>
        <?php
        include "section2.php";
        ?>
        <?php
        include "section3.php";
        ?>
    </div>
</div>