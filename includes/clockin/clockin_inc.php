<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once "../dbh_inc.php";
        require_once "./clockin_model.php";
        require_once "./clockin_contr.php";

        // check and select user from db
        $result = select_user($pdo, $email);

        // handle errors
        $errors = [];

        // empty field
        if (empty_input($email, $pwd)) {
            $errors["empty_input"] = "All fields are required!";
        }
        // wrong email
        if (wrong_email($result)) {
            $errors["wrong_info"] = "Incorrect login info!";
        }
        // wrong password
        if (!wrong_email($result) && wrong_pwd($pwd, $result["pwd"])) {
            $errors["wrong_info"] = "Incorrect login info!";
        }

        require_once "../session_config.php";
        if ($errors) {
            $_SESSION["login_errors"] = $errors;
            header("Location: ../../index.php");
            die();
        }

        // take attendance
        take_attendance($pdo, $result["id"]);

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_last_name"] = htmlspecialchars($result["last_name"]);
        $_SESSION["user_first_name"] = htmlspecialchars($result["first_name"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../../dashboard.php?clockin=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
