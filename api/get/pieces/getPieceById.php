<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Pieces.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, auth_token");
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  http_response_code(200);
  $pieceId = isset($_GET['pieceId'])?$_GET['pieceId']:null;
  $res = Pieces::getPieceById($pieceId);
  echo json_encode($res);
  return;
}
?>