<?php

declare(strict_types=1);

// check if email exist in db
function search_email(object $pdo, string $email)
{
    $query = "SELECT * FROM admin WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// register admin
function add_admin(object $pdo, string $first_name, string $last_name, string $email, string $pwd)
{
    $query = "INSERT INTO admin (first_name, last_name, email, pwd) VALUES (:first_name, :last_name, :email, :pwd);";

    $stmt = $pdo->prepare($query);

    $options = [
        "cost" => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);

    $stmt->execute();
}