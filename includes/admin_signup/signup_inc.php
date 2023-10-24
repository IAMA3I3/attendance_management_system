<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $confirm_pwd = $_POST["confirm_pwd"];

    try {
        require_once "../dbh_inc.php";
        require_once "./signup_model.php";
        require_once "./signup_contr.php";

        // handle errors
        $errors = [];

        // empty input
        if (empty_input($first_name, $last_name, $email, $pwd, $confirm_pwd)) {
            $errors["empty_input"] = "All fields are required";
        }
        // first name must be letters only
        if (not_alpha($first_name) && !empty($first_name)) {
            $errors["first_name_not_alpha"] = "First name must be letters only";
        }
        // last name must be letters only
        if (not_alpha($last_name)  && !empty($last_name)) {
            $errors["last_name_not_alpha"] = "Last name must be letters only";
        }
        // email is invalid
        if (invalid_email($email) && !empty($email)) {
            $errors["invalid_email"] = "Email is invalid";
        }
        // email is registered
        if (email_registered($pdo, $email)) {
            $errors["email_registered"] = "Email is already registered";
        }
        // pwd is too short
        if (is_short($pwd)  && !empty($pwd)) {
            $errors["short_pwd"] = "Password must be 4 or more characters long";
        }
        // pwd and confirm pwd must match
        if (no_match($pwd, $confirm_pwd)) {
            $errors["no_match"] = "Password and Confirm Password must be a match";
        }

        require_once "../session_config.php";

        if ($errors) {
            $_SESSION["signup_errors"] = $errors;
            $signup_data = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signup_data;
            header("Location: ../../admin_signup.php");
            die();
        }

        // register admin
        add_admin($pdo, $first_name, $last_name, $email, $pwd);

        header("Location: ../../admin_signup.php?signup=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin_signup.php");
    die();
}
