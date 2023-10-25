<?php

declare(strict_types=1);

// fetch all technicians
function fetch_all_technicians(object $pdo)
{
    $query = "SELECT * FROM users LEFT JOIN attendance ON users.id = attendance.user_id";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// fetch all technicians with attendance
function fetch_all_technicians_with_attendance(object $pdo, int $last_id)
{
    $query = "SELECT * FROM users U LEFT JOIN (SELECT * FROM attendance WHERE id = :last_id) A ON U.id = A.user_id";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":last_id", $last_id);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// get status
function get_status(object $pdo, int|null $user_id)
{
    $query = "SELECT user_status FROM attendance WHERE user_id = :user_id ORDER BY id DESC LIMIT 1";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}