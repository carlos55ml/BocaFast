<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Users.php';
use Firebase\JWT\JWT;


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, auth_token");
header('Content-Type: application/json');

function createSession($user) {
  $session_data = array(
    'id' => $user['id'],
    'username' => $user['username'],
    'admin' => $user['is_admin']
  );
  $token = JWT::encode($session_data, Config::$secret_key, 'HS256');
  $expires_at = time() + Config::$token_duration;
  return json_encode(array(
    'session_token' => $token,
    'expires_at' => $expires_at
  ));
}

function tryRegister($username, $password) {
  $res = Users::getUserByName($username);
  if ($res) {
    http_response_code(200);
    return json_encode(['error' => "El usuario '$username' ya existe."]);
  }
  $newUser = Users::createNewUser($username, $password);
  echo createSession($newUser);
  return;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = isset($_POST['username'])?$_POST['username']:null;
  $password = isset($_POST['password'])?$_POST['password']:null;

  if(!empty($username) and !empty($password)) {
    echo tryRegister($username, $password);
  } else {
    http_response_code(400);
    echo json_encode(['error' => 'Datos introducidos incorrectos.']);
  }

}

?>