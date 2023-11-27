<?php

declare(strict_types=1);

// fetch user
function fetch_user(object $pdo, $user_id)
{
    $query = "SELECT * FROM users WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// change password
function change_pwd(object $pdo, string $new_pwd, $user_id)
{
    $query = "UPDATE users SET pwd = :pwd WHERE id = :id;";

    $stmt = $pdo->prepare($query);

    $options = [
        "cost" => 12
    ];
    $hashedPwd = password_hash($new_pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":id", $user_id);

    $stmt->execute();
}