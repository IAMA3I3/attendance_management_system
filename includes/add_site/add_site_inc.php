<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $site_name = $_POST["site_name"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];

    try {
        require_once "../dbh_inc.php";
        require_once "./add_site_model.php";
        require_once "./add_site_contr.php";

        $errors = [];

        // empty inputs
        if (empty_input($site_name, $description, $location, $longitude, $latitude)) {
            $errors["empty_input"] = "All fields are required";
        }
        // site name exist
        if (site_name_taken($pdo, $site_name)) {
            $errors["site_name_taken"] = "Site name already exists";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["add_site_errors"] = $errors;
            $add_site_data = [
                "site_name" => $site_name,
                "description" => $description,
                "location" => $location,
                "longitude" => $longitude,
                "latitude" => $latitude
            ];
            $_SESSION["add_site_data"] = $add_site_data;

            header("Location: ../../manage_site.php");
            die();
        }

        // add_site
        add_site($pdo, $site_name, $description, $location, $longitude, $latitude);

        header("Location: ../../manage_site.php?add_site=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_site.php");
    die();
}
