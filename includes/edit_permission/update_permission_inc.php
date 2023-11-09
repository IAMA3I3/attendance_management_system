<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $permission_option_id = $_POST["permission_option_id"];
    // echo $permission_option_id;
    $title = $_POST["title"];
    $description = $_POST["description"];

    try {
        require_once "../dbh_inc.php";
        require_once "../add_permission/add_permission_model.php";
        require_once "../add_permission/add_permission_contrl.php";

        $errors = [];
        // empty inputs
        if (empty_input($title, $description)) {
            $errors["empty_input"] = "All fields are required";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["add_permission_errors"] = $errors;
            $add_permission_data = ["title"=> $title,"description"=> $description];
            $_SESSION["add_permission_data"] = $add_permission_data;

            header("Location: ../../manage_permissions.php?permission_edit=true");
            die();
        }

        // update permission
        update_permission($pdo, $permission_option_id, $title, $description);

        header("Location: ../../manage_permissions.php?update_permission=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_permissions.php");
    die();
}
