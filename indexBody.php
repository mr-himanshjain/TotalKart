<?php
include "slider.php";
?>
<div class="d-flex justify-content-evenly my-3">
    <div class="col-7 usersection">
        <?php if (empty($_COOKIE['token'])) { ?>
            <p>
                Hello User please <a href="login.php">click here to login</a>
            </p>
            <p>
                or you don't have account <a href="register.php">Click here to create a new account</a>;
            </p>
        <?php } else { ?>
            <p><?php echo $decoded->sub->name; ?></p>
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
        <?php
        include "section4.php";
        ?>
        <?php
        include "section5.php";
        ?>
        <?php
        include "sectionlast.php";
        ?>
    </div>
</div>