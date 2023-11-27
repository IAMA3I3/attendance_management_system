<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $current_pwd = $_POST["current_pwd"];
    $new_pwd = $_POST["new_pwd"];
    $confirm_pwd = $_POST["confirm_pwd"];

    try {
        require_once "../dbh_inc.php";
        require_once "../session_config.php";
        require_once "./change_pwd_model.php";
        require_once "./change_pwd_contrl.php";

        // fetch user
        $user = fetch_user($pdo, $user_id);

        $errors = [];

        // empty input
        if (empty_input($current_pwd, $new_pwd, $confirm_pwd)) {
            $errors["empty_input"] = "All fields are required";
        }
        // incorrect password
        if (!empty_input($current_pwd, $new_pwd, $confirm_pwd) && incorrect_pwd($current_pwd, $user["pwd"])) {
            $errors["incorrect_pwd"] = "Current password is incorrect";
        }
        // password too short
        if (!empty_input($current_pwd, $new_pwd, $confirm_pwd) && !incorrect_pwd($current_pwd, $user["pwd"]) && is_short($new_pwd)) {
            $errors["is_short"] = "New password must be 4 characters or more";
        }
        // new password and confirm password must be a match
        if (!empty_input($current_pwd, $new_pwd, $confirm_pwd) && !incorrect_pwd($current_pwd, $user["pwd"]) && !is_short($new_pwd) && no_match($new_pwd, $confirm_pwd)) {
            $errors["no_match"] = "New password and Confirm password must be a match";
        }

        if ($errors) {
            $_SESSION["change_pwd_errors"] = $errors;

            header("Location: ../../change_pwd.php");
            die();
        }

        // change password
        change_pwd($pdo, $new_pwd, $user_id);

        header("Location: ../../change_pwd.php?change_pwd=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " .  $e->getMessage());
    }
} else {
    header("Location: ../../change_pwd.php");
    die();
}
