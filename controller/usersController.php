<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/../model/Users.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'getAllUsers':
      return Users::getAllUsers();
      break;
  }
}

?>