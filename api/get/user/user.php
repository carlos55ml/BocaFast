<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/../../model/Users.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['id'])) {
  $res = Users::getUserById($_GET['id']);
  if (empty(json_decode($res, true))) {
    http_response_code(400);
    echo json_encode(array('error' => 'Bad Request.'));
  } else {
    http_response_code(200);
    echo $res;
  }
}

?>