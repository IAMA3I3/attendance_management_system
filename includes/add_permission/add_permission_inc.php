<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    try {
        require_once "../dbh_inc.php";
        require_once "./add_permission_model.php";
        require_once "./add_permission_contrl.php";

        $errors = [];
        // empty input
        if (empty_input($title, $description)) {
            $errors["empty_input"] = "All fields are required";
        }
        // title used
        if (title_used($pdo, $title)) {
            $errors["title_used"] = "This title have been used";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["add_permission_errors"] = $errors;
            $add_permission_data = ["title"=> $title,"description"=> $description];
            $_SESSION["add_permission_data"] = $add_permission_data;
            header("Location: ../../manage_permissions.php");
            die();
        }

        // add permission
        add_permission($pdo, $title, $description);

        header("Location: ../../manage_permissions.php?add_permission=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../manage_permissions.php");
    die();
}
