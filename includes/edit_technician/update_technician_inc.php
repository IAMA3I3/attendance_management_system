<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $technician_id = $_POST["technician_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $staff_id = (int)$_POST["staff_id"];
    $dob = $_POST["dob"];
    $site = $_POST["site"];
    $email = $_POST["email"];
    $status = $_POST["status"];

    try {
        require_once "../dbh_inc.php";
        require_once "./update_technician_model.php";
        require_once "./update_technician_contrl.php";

        $errors = [];

        // empty inputs
        if (empty_input($first_name, $last_name, $staff_id, $dob, $site, $email, $status)) {
            $errors["empty_input"] = "All fields are required";
        }
        // first name not alphabet
        if (not_alpha($first_name)) {
            $errors["first_name_not_alpha"] = "First name must contain only letters";
        }
        // last name not alphabet
        if (not_alpha($first_name)) {
            $errors["last_name_not_alpha"] = "Last name must contain only letters";
        }
        // invalid email
        if (!empty($email) && invalid_email($email)) {
            $errors["invalid_email"] = "Email is invalid";
        }
        // staff id taken exclude this
        if (staff_id_taken_by_other($pdo, $staff_id, $technician_id)) {
            $errors["staff_id_taken"] = "Staff ID is already taken by another technician";
        }
        // email taken exclude this
        if (email_taken_by_other($pdo, $email, $technician_id)) {
            $errors["email_taken"] = "Email is already registered to another technician";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["update_technician_errors"] = $errors;
            $update_technician_data = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "staff_id" => $staff_id,
                "dob" => $dob,
                "site" => $site,
                "email" => $email,
                "status" => $status
            ];
            $_SESSION["update_technician_data"] = $update_technician_data;

            header("Location: ../../admin_dashboard.php?edit_technician=true");
            die();
        }

        // update technician
        update_technician($pdo, $technician_id, $first_name, $last_name, $staff_id, $dob, $site, $email, $status);

        header("Location: ../../admin_dashboard.php?update_technician=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../admin_dashboard.php");
    die();
}
