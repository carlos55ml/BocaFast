<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Ingredients.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, auth_token");
header('Content-Type: application/json');

function noAuthorized() {
  http_response_code(401);
  echo json_encode(['error' => 'No estas autorizado a hacer esto']);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset(getallheaders()['auth_token'])) {
    $token = getallheaders()['auth_token'];
    $decoded = (array) JWT::decode($token, new Key(Config::$secret_key, 'HS256'));
    
    if($decoded['admin'] and $decoded['admin']==1) {
      $ingredientId = isset($_GET['ingredientId'])?$_GET['ingredientId']:null;
      http_response_code(200);
      $res = Ingredients::deleteIngredient($ingredientId);
      echo json_encode($res);
      return;
    }
    noAuthorized();
    return;
  }
  noAuthorized();
  return;
}
?>