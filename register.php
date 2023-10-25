<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Register Technician</title>
</head>

<body>
    <div class="container">

        <!-- feedbacks -->
        <?php if (isset($_SESSION["register_errors"])) { ?>
            <?php $errors = $_SESSION["register_errors"]; ?>

            <?php foreach ($errors as $error) { ?>
                <div class="error-message">
                    <div class="error-text">
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php } ?>

            <!--  -->
        <?php } ?>
        <!--  -->

        <!--  -->
        <div class="font-lg">REGISTER TECHNICIAN</div>
        <form class="btw-y" action="./includes/register/register_inc.php" method="post">
            <!--  -->
            <div>
                <label for="first-name">First Name</label>
                <?php if (isset($_SESSION["input_data"]["first_name"]) && !isset($_SESSION["register_errors"]["first_name_not_alpha"])) { ?>
                    <input type="text" name="first_name" id="first-name" value="<?php echo $_SESSION["input_data"]["first_name"]; ?>">
                <?php } else { ?>
                    <input type="text" name="first_name" id="first-name">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="last-name">Last Name</label>
                <?php if (isset($_SESSION["input_data"]["last_name"]) && !isset($_SESSION["register_errors"]["last_name_not_alpha"])) { ?>
                    <input type="text" name="last_name" id="last-name" value="<?php echo $_SESSION["input_data"]["last_name"]; ?>">
                <?php } else { ?>
                    <input type="text" name="last_name" id="last-name">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="id-number">ID Number</label>
                <?php if (isset($_SESSION["input_data"]["id_number"]) && !isset($_SESSION["register_errors"]["id_registered"])) { ?>
                    <input type="number" name="id_number" id="id-number" value="<?php echo $_SESSION["input_data"]["id_number"]; ?>">
                <?php } else { ?>
                    <input type="number" name="id_number" id="id-number">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="dob">Date of Birth</label>
                <?php if (isset($_SESSION["input_data"]["dob"])) { ?>
                    <input type="date" name="dob" id="dob" value="<?php echo $_SESSION["input_data"]["dob"] ?>">
                <?php } else { ?>
                    <input type="date" name="dob" id="dob">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="date-employed">Date Employed</label>
                <?php if (isset($_SESSION["input_data"]["date_employed"])) { ?>
                    <input type="date" name="date_employed" id="date-employed" value="<?php echo $_SESSION["input_data"]["date_employed"] ?>">
                    <?php } else { ?>
                <input type="date" name="date_employed" id="date-employed">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="site">Site</label>
                <select name="site" id="site">
                    <option value=""></option>
                    <option value="gemsarena">Gems Arena</option>
                    <option value="gemscitygate">Gems City Gate</option>
                    <option value="gemscmd">Gems CMD</option>
                    <option value="gemsrock">Gems Rock</option>
                    <option value="gemstower">Gems Tower</option>
                </select>
            </div>
            <!--  -->
            <div>
                <label for="email">Email</label>
                <?php if (isset($_SESSION["input_data"]["email"]) && !isset($_SESSION["register_errors"]["invalid_email"]) && !isset($_SESSION["register_errors"]["email_registered"])) { ?>
                    <input type="text" name="email" id="email" value="<?php echo $_SESSION["input_data"]["email"]; ?>">
                <?php } else { ?>
                    <input type="text" name="email" id="email">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd">
            </div>
            <!--  -->
            <div>
                <label for="confirm-pwd">Confirm Password</label>
                <input type="password" name="confirm_pwd" id="confirm-pwd">
            </div>
            <!--  -->
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>

<!--  -->
<?php unset($_SESSION["register_errors"]); ?>
<?php unset($_SESSION["input_data"]); ?>