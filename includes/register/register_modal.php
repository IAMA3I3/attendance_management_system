<?php

declare(strict_types=1);

// check if id number exist in db
function search_id(object $pdo, int $id_number)
{
    $query = "SELECT * FROM users WHERE id_number = :id_number;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_number", $id_number);
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
function add_user(object $pdo, string $first_name, string $last_name, int $id_number, $dob, $date_employed, $site, string $email, string $pwd)
{
    $query = "INSERT INTO users (first_name, last_name, id_number, dob, date_employed, site, email, pwd) VALUES (:first_name, :last_name, :id_number, :dob, :date_employed, :site, :email, :pwd);";

    $stmt = $pdo->prepare($query);

    $options = [
        "cost" => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":id_number", $id_number);
    $stmt->bindParam(":dob", $dob);
    $stmt->bindParam(":date_employed", $date_employed);
    $stmt->bindParam(":site", $site);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);

    $stmt->execute();
}