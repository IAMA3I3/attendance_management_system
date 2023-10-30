<?php

declare(strict_types=1);

// check if id number exist in db
function search_id(object $pdo, int $staff_id)
{
    $query = "SELECT * FROM users WHERE staff_id = :staff_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":staff_id", $staff_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// check if email exist in db
function search_email(object $pdo, string $email)
{
    $query = "SELECT * FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// register user
function add_user(object $pdo, string $first_name, string $last_name, int $staff_id, $dob, $site, string $email, string $pwd, string $passport)
{
    $query = "INSERT INTO users (first_name, last_name, staff_id, dob, site, email, pwd, passport, status) VALUES (:first_name, :last_name, :staff_id, :dob, :site, :email, :pwd, :passport, 'Active');";

    $stmt = $pdo->prepare($query);

    $options = [
        "cost" => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":staff_id", $staff_id);
    $stmt->bindParam(":dob", $dob);
    $stmt->bindParam(":site", $site);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":passport", $passport);

    $stmt->execute();
}