<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Users.php';
use Firebase\JWT\JWT;


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


function createSession($user) {
  $session_data = array(
    'id' => $user['id'],
    'username' => $user['username'],
    'admin' => $user['isAdmin']
  );
  $token = JWT::encode($session_data, Config::$secret_key, 'HS256');
  $expires_at = time() + Config::$token_duration;
  return json_encode(array(
    'session_token' => $token,
    'expires_at' => $expires_at
  ));
}

function tryUserLogin($username, $password) {
  $user = json_decode(Users::getUserByName($username), true);
  // Si el usuario no existe devolvemos error
  if (empty($user)) {
    http_response_code(400);
    echo json_encode(array('error' => 'El usuario no existe.'));
    return;
  }
  if($user['passwd'] != $password) {
    http_response_code(401);
    echo json_encode(array('error' => 'contra incorrecta.'));
    return;
  }

  // Si pasa todos los filtros, login correcto

  http_response_code(200);
  echo createSession($user);
  return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = isset($_POST['username'])?$_POST['username']:null;
  $password = isset($_POST['password'])?$_POST['password']:null;

  if(!is_null($username) and !is_null($password)) {
    tryUserLogin($username, $password);
  }
  // session_start();
  // http_response_code(200);
  // if (isset($_SESSION['id'])) {
  //   echo json_encode(array(
  //     'logged' => 'true',
  //     'userId' => $_SESSION['id'],
  //     'userName' => $_SESSION['username']
  //   ));
  // } else {
  //   echo json_encode(array(
  //     'logged' => 'false'
  //   ));
  // }
}

?>