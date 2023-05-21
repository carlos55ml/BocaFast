<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/Pieces.php';
require_once __DIR__ . '/../../helpers/images/image.php';
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
      
      $nombreBocata = isset($_POST['nombreBocata'])?$_POST['nombreBocata']:null;
      $ingredientesBocata = isset($_POST['ingredientesBocata'])?$_POST['ingredientesBocata']:null;
      $precioBocata = isset($_POST['precioBocata'])?$_POST['precioBocata']:null;
      $descripcionBocata = isset($_POST['descripcionBocata'])?$_POST['descripcionBocata']:null;
      $imagenBocata = isset($_FILES['imagenBocata'])?$_FILES['imagenBocata']:null;
      if($imagenBocata) $imagenUrl = uploadToImgur($imagenBocata);

      http_response_code(200);
      $res = Pieces::saveNewPiece($nombreBocata, $ingredientesBocata, $precioBocata, $descripcionBocata, $imagenUrl);
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