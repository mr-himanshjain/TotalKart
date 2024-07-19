<?php
include "slider.php";
?>
<div class="index-div-card" style="display: <?= $hideDivs; ?>">
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-7 col-md-7 col-sm-7 col-7 profile-section usersection">
            <?php if (empty($_COOKIE['token'])) { ?>
                <p class="p-4 text-xl" style="font-weight:500; color:#7c7c7c">
                    Welcome! Enjoy seamless shopping and exclusive deals. Sign up for a personalized experience!
                </p>
                <div class="d-flex justify-content-evenly text-center action-button p-3">
                    <div class="col-5 mb-2">
                        <a href="login.php" class="btn btn-primary text-white w-75">Login</a>
                    </div>
                    <div class="col-6 mb-2">
                        <a href="register.php" class="btn btn-light w-75">SignUp</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex user-details">
                    <div class="profile-img mb-3">
                        <img src="./img/avatar.png" alt="profile-img" class="img-fluid rounded-circle"
                            style="width: 100px; height: 100px;">
                    </div>
                    <div class="user-name">
                        <p>Hii..! </p>
                        <p><?php echo $_SESSION['user']['name']; ?></p>
                    </div>
                </div>
                <div class="row user-action text-center justify-content-evenly">
                    <div class="col-5 mb-2">
                        <a href="order.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Your Order</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="wishlist.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Your List</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="profile.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Account</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="favorites.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Favorites</a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col-xxl-4 col-md-4 col-sm-4 col-4 usersection align-items-center justify-content-center">
            <?php require './featureproduct/featureproduct1.php'; ?>
        </div>
    </div>
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-4 col-md-4 col-sm-4 col-4 usersection align-items-center justify-content-center">
            <?php require './featureproduct/featureproduct2.php'; ?>
        </div>
        <div class="col-xxl-7 col-md-7 col-sm-7 col-7 usersection" style="overflow:hidden">
            <div class="slider-container">
                <div class="slider">
                    <div class="slide"><img
                            src="https://i.gadgets360cdn.com/large/amazon_summer_sale_2022_oneplus_redmi_samsung_1651048043298.jpg?downsize=950:*"
                            alt="Image 1"></div>
                    <div class="slide"><img
                            src="https://poweradspy.com/wp-content/uploads/2020/08/top-03-mobile-advertising-platforms-used-by-the-digital-marketers-1-1-750x465-65d310ec13850.webp"
                            alt="Image 2"></div>
                    <div class="slide"><img
                            src="https://in-files.apjonlinecdn.com/landingpages/content-pages/student-store/images/w100_ssbtc_mobile_v1.jpg"
                            alt="Image 3"></div>
                </div>
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-7 col-md-7 col-sm-7 col-7 usersection align-item-center justify-content-center">
            <?php require './featureproduct/featureproduct3.php'; ?>
        </div>
        <div class="col-xxl-4 col-md-4 col-sm-4 col-4 usersection justify-content-center" style="align-items: center;">
            <?php require './featureproduct/featureproduct4.php'; ?>
        </div>
    </div>
</div>
<div class="small-screen-index-div mx-2" style="display: <?= $hidesecondDivs; ?>">
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-7 col-md-7 col-sm-7 col-12 profile-section usersection">
            <?php if (empty($_COOKIE['token'])) { ?>
                <p class="p-4 text-xl" style="font-weight:500; color:#7c7c7c">
                    Welcome! Enjoy seamless shopping and exclusive deals. Sign up for a personalized experience!
                </p>
                <div class="d-flex justify-content-evenly text-center action-button p-3">
                    <div class="col-5 mb-2">
                        <a href="login.php" class="btn btn-primary text-white w-75">Login</a>
                    </div>
                    <div class="col-6 mb-2">
                        <a href="register.php" class="btn btn-light w-75">SignUp</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex user-details">
                    <div class="profile-img mb-3">
                        <img src="./img/avatar.png" alt="profile-img" class="img-fluid rounded-circle"
                            style="width: 100px; height: 100px;">
                    </div>
                    <div class="user-name">
                        <p>Hii..! </p>
                        <p><?php echo $_SESSION['user']['name']; ?></p>
                    </div>
                </div>
                <div class="row user-action2 user-action3  text-center justify-content-evenly">
                    <div class="col-5 mb-2">
                        <a href="order.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Your Order</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="wishlist.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Your List</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="profile.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Account</a>
                    </div>
                    <div class="col-5 mb-2">
                        <a href="favorites.php?user_id=<?php echo $_SESSION['user']['id'] ?>" class="btn w-75">Favorites</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="d-flex justify-content-between my-3 mx-1">
        <div class="col-xxl-3 col-md-3 col-sm-3 col-4 usersection align-items-center justify-content-center">
            <?php require './featureproduct/featureproduct1.php'; ?>
        </div>
        <div class="col-xxl-3 col-md-3 col-sm-3 col-4 mx-1 usersection align-items-center justify-content-center">
            <?php require './featureproduct/featureproduct2.php'; ?>
        </div>
        <div class="col-xxl-3 col-md-3 col-sm-3 col-4 usersection justify-content-center" style="align-items: center;">
            <?php require './featureproduct/featureproduct4.php'; ?>
        </div>
    </div>
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-7 col-md-7 col-sm-7 col-12 usersection" style="overflow:hidden">
            <div class="slider-container">
                <div class="slider">
                    <div class="slide"><img
                            src="https://i.gadgets360cdn.com/large/amazon_summer_sale_2022_oneplus_redmi_samsung_1651048043298.jpg?downsize=950:*"
                            alt="Image 1"></div>
                    <div class="slide"><img
                            src="https://poweradspy.com/wp-content/uploads/2020/08/top-03-mobile-advertising-platforms-used-by-the-digital-marketers-1-1-750x465-65d310ec13850.webp"
                            alt="Image 2"></div>
                    <div class="slide"><img
                            src="https://in-files.apjonlinecdn.com/landingpages/content-pages/student-store/images/w100_ssbtc_mobile_v1.jpg"
                            alt="Image 3"></div>
                </div>
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly my-3">
        <div class="col-xxl-7 col-md-7 col-sm-7 col-12 usersection align-item-center justify-content-center">
            <?php require './featureproduct/featureproduct3.php'; ?>
        </div>
    </div>
</div>
<div class="firstCard container">
    <div class="contentbody">
        <?php
        include "sections.php";
        ?>
    </div>
</div>