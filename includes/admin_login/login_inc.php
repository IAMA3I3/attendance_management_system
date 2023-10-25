<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once "../dbh_inc.php";
        require_once "./login_model.php";
        require_once "./login_contr.php";

        // check and select admin from db
        $result = select_admin($pdo, $email);

        // handle errors
        $errors = [];

        // empty field
        if (empty_input($email, $pwd)) {
            $errors["empty_input"] = "All fields are required!";
        }
        // wrong email
        if (wrong_email($result) && !empty_input($email, $pwd)) {
            $errors["wrong_info"] = "Incorrect login info!";
        }
        // wrong password
        if (!wrong_email($result) && wrong_pwd($pwd, $result["pwd"]) && !empty_input($email, $pwd)) {
            $errors["wrong_info"] = "Incorrect login info!";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["login_errors"] = $errors;
            header("Location: ../../admin.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["admin_id"] = $result["id"];
        $_SESSION["admin_last_name"] = htmlspecialchars($result["last_name"]);
        $_SESSION["admin_first_name"] = htmlspecialchars($result["first_name"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../../admin_dashboard.php?login=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin.php");
    die();
}
