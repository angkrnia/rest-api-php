<?php
require_once 'init.php';
$user = new UsersService($conn);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		try {
			if (!isset($url[1])) {
				throw new Exception("Id is empty", 400);
			}
			$id = $url[1];
			$result = $user->getOne($id);
		} catch (Exception $e) {
			$response = [
				"status" => "fail",
				"message" => $e->getMessage()
			];
			http_response_code($e->getCode());
			header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}
		$response = [
			"status" => "success",
			"data" => $result->fetchAll(PDO::FETCH_ASSOC)
		];
		http_response_code(200);
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
	case 'POST':
		try {
			$data = json_decode(file_get_contents('php://input'), true);
			$result = $user->create($data);
		} catch (Exception $e) {
			$response = [
				"status" => "fail",
				"message" => $e->getMessage()
			];
			http_response_code($e->getCode());
			header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}
		$response = [
			"status" => "success",
			"message" => [
				"id" => $result
			]
		];
		http_response_code(201);
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
}
