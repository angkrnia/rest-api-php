<?php
require_once 'init.php';
$mhs = new MahasiswaService($conn);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		try {
			if (isset($url[1])) {
				$id = $url[1];
				$result = $mhs->getOne($id);
			} else {
				$result = $mhs->getAll();
			}
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
			mahasiswaValidator($data);
			$result = $mhs->create($data);
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
	case 'PUT':
		try {
			if (!isset($url[1])) {
				throw new Exception("id not found", 400);
			}
			$id = $url[1];
			$data = json_decode(file_get_contents('php://input'), true);
			$result = $mhs->update($data, $id);
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
			"message" => "data updated"
		];
		http_response_code(200);
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
	case 'DELETE':
		try {
			if (!isset($url[1])) {
				throw new Exception("id not found", 400);
			}
			$id = $url[1];
			$result = $mhs->delete($id);
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
			"message" => "data deleted"
		];
		http_response_code(200);
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
	default:
		$response = [
			"status" => "fail",
			"message" => "not found"
		];
		http_response_code(404);
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
}
