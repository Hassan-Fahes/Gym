<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
function checkToken($headers) {
    
    require __DIR__ . '/../../../vendor/autoload.php';
    // ENV
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
    $dotenv->load();
    // For Token
    $key = $_ENV['JWT_SECRET'];
    $authHeader = $headers["Authorization"] ?? "";

    if (!$authHeader || !str_starts_with($authHeader, "Bearer ")) {
        return "Token not provided";  
    }

    $jwt = str_replace("Bearer ", "", $authHeader);

    try {
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        return $decoded->user;
    } catch (Exception $e) {
        return "Invalid token";
    }
}