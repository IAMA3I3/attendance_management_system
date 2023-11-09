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

// update login time
function update_login_time(object $pdo, $current_time, $user_id)
{
    $query = "UPDATE users SET last_login = :current_time WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":current_time", $current_time);
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();
}

// take attendance
function take_attendance(object $pdo, int $user_id)
{
    $register = 1;
    $query = "INSERT INTO attendance (user_id, register) VALUES (:user_id, :register)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":register", $register);
    $stmt->execute();

    $last_id = $pdo->lastInsertId();

    $_SESSION["last_id"] = $last_id;
}


// check if same day in db
function is_same_day(object $pdo, $current_time, $user_id)
{
    $query = "SELECT last_login FROM users WHERE id = :id AND last_login = :current_time;";

    $stmt = $pdo->prepare($query); 
    $stmt->bindParam("current_time", $current_time);
    $stmt->bindParam("id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  

    return $result;
}