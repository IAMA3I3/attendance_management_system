<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $staff_id = (int)$_POST["staff_id"];
    $dob = $_POST["dob"];
    $site = $_POST["site"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $confirm_pwd = $_POST["confirm_pwd"];

    $passport = $_FILES["passport"];
    $passport_name = $_FILES["passport"]["name"];
    $passport_tmp_name = $_FILES["passport"]["tmp_name"];
    $passport_size = $_FILES["passport"]["size"];
    $passport_error = $_FILES["passport"]["error"];
    $passport_type = $_FILES["passport"]["type"];

    try {
        require_once "../dbh_inc.php";
        require_once "./register_modal.php";
        require_once "./register_contr.php";

        // handle errors
        $errors = [];

        $passport_ext = explode(".", $passport_name);
        $passport_act_ext = strtolower(end($passport_ext));

        $allowed = ["jpg", "jpeg", "png"];

        if (in_array($passport_act_ext, $allowed)) {
            if ($passport_error === 0) {
                if ($passport_size < 1000000) {
                    $passport_new_name = uniqid('', true) . "." . $passport_act_ext;
                    $passport_dest = "../../uploads/".$passport_new_name;
                    move_uploaded_file($passport_tmp_name, $passport_dest);
                } else {
                    $errors["large_size"] = "Passport size is too large";
                }
            } else {
                $errors["upload_error"] = "Error uploading passport";
            }
        } else {
            $errors["invalid_type"] = "Passport type is not allowed";
        }

        // empty input
        if (empty_input($first_name, $last_name, $staff_id, $dob, $site, $email, $pwd, $confirm_pwd)) {
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
        // id number is registered
        if (id_registered($pdo, $staff_id)) {
            $errors["id_registered"] = "ID number is already registered";
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
            $_SESSION["register_errors"] = $errors;
            $input_data = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "staff_id" => $staff_id,
                "dob" => $dob,
                "date_employed" => $date_employed,
                "site" => $site,
                "email" => $email
            ];
            $_SESSION["input_data"] = $input_data;
            header("Location: ../../register.php");
            die();
        }

        // register user
        add_user($pdo, $first_name, $last_name, $staff_id, $dob, $site, $email, $pwd, $passport_new_name);

        header("Location: ../../register.php?register=success");

        $stmt = null;
        $pdo = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../register.php");
    die();
}
