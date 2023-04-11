<?php
require_once __DIR__ . '../DB.php';

class Users {
  public static function getAllUsers() {
    $res = DB::preparedQuery(
    'SELECT * FROM users',
    []);
    return json_encode($res);
  }

  public static function getUserById($id) {
    $res = DB::preparedQuery(
      'SELECT * FROM users WHERE id=?',
      [$id]
    )[0];
    return json_encode($res);
  }

  public static function getUserByName($name) {
    $res = DB::preparedQuery(
      'SELECT * FROM users WHERE username=?',
      [$name]
    )[0];
    return json_encode($res);
  }
}
?>