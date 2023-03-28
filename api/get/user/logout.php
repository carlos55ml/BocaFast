<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once __DIR__ . '/../../model/Users.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  session_start();
  if (isset($_SESSION['id'])) {
    http_response_code(200);

    session_destroy();
    echo json_encode(array(
      'logOut' => 'true',
    ));
  } else {
    http_response_code(401);
    echo json_encode(array(
      'error' => 'No session found to log out.'
    ));
  }
}

?>