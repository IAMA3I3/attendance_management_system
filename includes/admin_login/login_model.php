<?php

declare(strict_types=1);

// check and select admin from db
function select_admin(object $pdo, string $email)
{
    $query = "SELECT * FROM admin WHERE email = :email";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}