<?php

$HOST = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'angga_201011401198';

try {
    $conn = new PDO("mysql:host=$HOST;dbname=$DB", $USERNAME, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
