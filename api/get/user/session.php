<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/../../model/Users.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  http_response_code(200);
  if (isset($_SESSION['id'])) {
    echo json_encode(array(
      'logged' => 'true',
      'userId' => $_SESSION['id'],
      'userName' => $_SESSION['username']
    ));
  } else {
    echo json_encode(array(
      'logged' => 'false'
    ));
  }
}

?>