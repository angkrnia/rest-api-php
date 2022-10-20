<?php

$HOST = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'angga_201011401198';

try {
    $option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $conn = new PDO("mysql:host=$HOST;dbname=$DB", $USERNAME, $PASSWORD, $option);
} catch (Exception $e) {
    $response = [
        "status" => "fail",
        "message" => $e->getMessage()
    ];
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
