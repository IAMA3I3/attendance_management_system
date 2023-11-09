<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $permission = $_POST["select_permission"];
    $other_reason = $_POST["other_reason"];
    $duration = $_POST["duration"];

    try {
        require_once "../dbh_inc.php";
        require_once "./take_permission_model.php";
        require_once "./take_permission_contr.php";

        $errors = [];
        // empty input
        if (empty_input($permission, $duration)) {
            $errors["empty_input"] = "Fill in required fields";
        }
        // must fill other reason if other selected
        if (!empty_input($permission, $duration) && other_selected($permission, $other_reason)) {
            $errors["other_field"] = "Fill in 'Other Reason' field when 'Other' permission is selected";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["take_permission_errors"] = $errors;
            header("Location: ../../take_permission.php");
            die();
        }

        // send permission
        send_permission($pdo, $user_id, $permission, $duration);

        header("Location: ../../take_permission.php?take_permission=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../take_permission.php");
    die();
}
