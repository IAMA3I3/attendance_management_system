<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ./index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Technician</title>
</head>

<body>
    <!--  -->
    <div class="dashboard">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav active" href="#"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav" href="./take_permission.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i><span>Take Permission</span></a>
                    <!--  -->
                </div>
            </div>
            <div class="menu-ic">
                <i class="fa-solid fa-bars" id="bars"></i>
            </div>
        </div>

        <!--  -->
        <div class="body">
            <!--  -->
            <?php if (isset($_GET["clockin"]) && $_GET["clockin"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Clocked In</div>
                </div>
            <?php } ?>
            <!--  -->
            <div class="mb-lg"></div>
            <div class="flex space-btw">
                <div class="flex gap">
                    <div class="img-container">
                        <img src="./uploads/<?php echo htmlspecialchars($_SESSION["user"]["passport"]) ?>" alt="">
                    </div>
                    <div class="">
                        <div class="font-xl">Dashboard</div>
                        <!--  -->
                        <div class="mb"><?php echo htmlspecialchars($_SESSION["user"]["first_name"]) . " " . htmlspecialchars($_SESSION["user"]["last_name"]); ?></div>
                    </div>
                </div>
                <div class="">
                    <!--  -->
                    <form action="./includes/clockout/clockout_inc.php" method="post" onsubmit="return confirm('You will not be able to clock in again today, Do you really want to Clock out now?');">
                        <!-- <button type="submit" class="btn-outline">Clock Out</button> -->
                        <?php if (isset($_SESSION["permission_state"])) { ?>
                            <div class="btn bg-light" onclick="alert('Permission is on going')">Clock Out</div>
                        <?php } else { ?>
                            <button type="submit" class="btn-outline">Clock Out</button>
                        <?php } ?>
                        <div class="font-sm light-text text-center">At <span id="live-time"></span></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/display_live_time.js"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>