<?php

declare(strict_types=1);

// fetch technician with attendance
function fetch_technician_with_attendance(object $pdo, $user_id)
{
    $query = "SELECT * FROM users LEFT JOIN attendance ON users.id = attendance.user_id WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// fetch technician without attendance
function fetch_technician(object $pdo, $user_id)
{
    $query = "SELECT * FROM users WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $user_id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}