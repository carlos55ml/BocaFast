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

  public static function createNewUser(string $username, string $password) {
    $createdUserId = DB::preparedQueryRetId(
      'INSERT INTO users(username, passwd, is_admin) VALUES (?, ?, 0)',
      [$username, $password]
    );
    if (!$createdUserId) {
      return null;
    }
    $res = DB::preparedQuery(
      'SELECT * FROM users WHERE id=?',
      [$createdUserId]
    );
    if($res and $res[0]) return $res[0];
    return null;
  }
}
?>