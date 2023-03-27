<?php
require_once __DIR__ . '../DB.php';

class Users {
  public static function getAllUsers() {
    $res = DB::preparedQuery(
    'SELECT * FROM users',
    []
  );
  // print_r($res);
  echo json_encode($res);
  }
}
?>