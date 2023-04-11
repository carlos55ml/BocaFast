<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Users.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, auth_token");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  http_response_code(200);
  if (isset(getallheaders()['auth_token'])) {
    $token = getallheaders()['auth_token'];
    $decoded = JWT::decode($token, new Key(Config::$secret_key, 'HS256'));
    echo json_encode($decoded);
  } else {
    echo json_encode([
      "logged" => "false"
    ]);
  }
}

?>