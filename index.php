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
    <div class="container">
        <!--  -->
        <div class="font-lg">CLOCK IN</div>
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

    <script src="./js/script.js"></script>
</body>

</html>