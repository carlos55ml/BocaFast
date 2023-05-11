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
    );
    if($res and $res[0]) return json_encode($res[0]);
    return null;
  }

  public static function getUserByName($name) {
    $res = DB::preparedQuery(
      'SELECT * FROM users WHERE username=?',
      [$name]
    );
    if($res and $res[0]) return json_encode($res[0]);
    return null;
  }
}
?>