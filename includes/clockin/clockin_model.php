<?php

declare(strict_types=1);

// check for email in db
function select_user(object $pdo, string $email)
{
    $query = "SELECT * FROM users WHERE email = :email";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// take attendance
function take_attendance(object $pdo, int $user_id)
{
    $register = 1;
    $query = "INSERT INTO attendance (user_id, register) VALUES (:user_id, :register)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":register", $register);
    $stmt->execute();

    $last_id = $pdo->lastInsertId();

    $_SESSION["last_id"] = $last_id;
}
