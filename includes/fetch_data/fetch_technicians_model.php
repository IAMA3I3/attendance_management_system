<?php

declare(strict_types=1);

// fetch all technicians
function fetch_all_technicians(object $pdo)
{
    $query = "SELECT * FROM users;";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// fetch technician register
function fetch_technician_register(object $pdo, $user_id)
{
    $query = "SELECT * FROM attendance WHERE user_id = :user_id ORDER BY id DESC;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// fetch register date time
// function fetch_technician_register(object $pdo, $user_id)
// {
//     $query = "SELECT register FROM attendance WHERE user_id = :user_id ORDER BY id DESC;";

//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(":user_id", $user_id);

//     $stmt->execute();

//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $result;
// }