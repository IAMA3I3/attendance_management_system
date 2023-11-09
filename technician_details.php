<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}

if (!isset($_GET["technician_id"])) {
    header("Location: ./admin_dashboard.php");
    die();
}

require_once "./includes/dbh_inc.php";
require_once "./includes/technician_details/technician_details_model.php";
require_once "./includes/technician_details/technician_details_inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Technician Details</title>
</head>

<body>
    <!--  -->
    <div class="container">
        <!--  -->
        <div class="mb"></div>
        <div class="mb">
            <a href="javascript:history.go(-1)" class="font-xl ic-btn"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <!--  -->
        <div class="flex gap-xl mb-lg">
            <div class="">
                <div class="img-container">
                    <img src="./uploads/<?php echo htmlspecialchars($last_technician_details["passport"]) ?>" alt="">
                </div>
            </div>
            <div class="card flex space-around flex-1">
                <div class="">
                    <div class=""><b>Name:</b> <?php echo htmlspecialchars($last_technician_details["first_name"]) . " " . htmlspecialchars($last_technician_details["last_name"]) ?></div>
                </div>
                <div class="">
                    <div class=""><b>Email:</b> <?php echo htmlspecialchars($last_technician_details["email"]) ?></div>
                </div>
                <div class="">
                    <div class=""><b>Staff ID:</b> <?php echo htmlspecialchars($last_technician_details["staff_id"]) ?></div>
                </div>
                <div class="">
                    <div class=""><b>Site:</b> <?php echo htmlspecialchars($last_technician_details["site"]) ?></div>
                </div>
                <div class="">
                    <div class=""><b>Status:</b> <?php echo htmlspecialchars($last_technician_details["status"]) ?></div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="card mb-lg">
            <div class="font-lg mb">ATTENDANCE</div>
            <table class="mb">
                <tr class="bold-text">
                    <td>Date</td>
                    <td>Clock In</td>
                    <td>Clock Out</td>
                </tr>
                <?php for ($i = -7; $i <= 3; $i++) { ?>
                    <tr class="<?php echo (date("d") == date("d", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")))) ? 'bg-primary white-text' : ''; ?>">
                        <td><?php echo date("l", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))) . ", " . date("d-M-Y", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))) ?></td>
                        <td>
                            <?php foreach ($att_dates as $att_date) { ?>
                                <?php if ($att_date["date"] == date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")))) { ?>
                                    <div class="">Clocked In at <?php echo date("h:i:s a", strtotime($att_date["clockin"])) ?></div>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?php foreach ($date_times as $date_time) { ?>
                                <?php if ($date_time["clockout_date"] == date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")))) { ?>
                                    <div class="">Clocked Out at <?php echo date("h:i:s a", strtotime($date_time["clockout_time"])) ?></div>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <!--  -->
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
</body>

</html>