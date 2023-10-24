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
    $query = "INSERT INTO attendance (user_id) VALUES (:user_id)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}