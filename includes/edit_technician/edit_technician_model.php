<?php

declare(strict_types= 1);

// fetch technician from db
function fetch_technician(object $pdo, $technician_id)
{
    $query = "SELECT * FROM users WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $technician_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}