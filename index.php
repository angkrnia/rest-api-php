<?php

function getUrl()
{
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}

$url = getUrl();

if (isset($url[0])) {
    switch ($url[0]) {
        case 'mahasiswa':
            require_once 'api/mahasiswa.php';
            break;
        case 'users':
            require_once 'api/users.php';
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
}
