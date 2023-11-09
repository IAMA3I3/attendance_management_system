<?php

require_once "./includes/session_config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Clock In</title>
</head>

<body>
    <div class="form-page">
        <!-- bg -->
        <img src="./assets/login.jpg" alt="" class="bg">


        <div class="form-card-container">
            <div class="form-card">
                <!--  -->
                <div class="logo mb">
                    <img src="./assets/gemsLogo.png" alt="">
                </div>
                <!--  -->
                <div class="font-lg mb">CLOCK IN</div>
                <!-- feedbacks -->
                <?php if (isset($_SESSION["clockin_errors"])) { ?>
                    <?php $errors = $_SESSION["clockin_errors"]; ?>

                    <?php foreach ($errors as $error) { ?>
                        <div class="error-message" id="pop-up">
                            <div class="error-text">
                                <?php echo $error; ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!--  -->
                <?php } ?>
                <!--  -->

                <form class="btw-y" action="./includes/clockin/clockin_inc.php" method="post">
                    <!--  -->
                    <div>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <!--  -->
                    <div>
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd">
                    </div>
                    <!--  -->
                    <div>
                        <label for="clockin-time">Clock In Time</label>
                        <input type="text" name="clockin_time" id="clockin-time" value="" disabled>
                    </div>
                    <!--  -->
                    <button type="submit" class="btn">Clock In</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/input_live_time.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>

<?php unset($_SESSION["clockin_errors"]); ?>