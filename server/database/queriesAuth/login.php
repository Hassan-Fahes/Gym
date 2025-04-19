<?php
function login($username, $password){
    require_once __DIR__ . '/../connection.php';
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }

    } catch (PDOException $e) {
        return $e;
    }
}