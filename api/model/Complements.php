<?php
require_once __DIR__ . '../DB.php';

class Complements {
  public static function countAllComplements() {
    return DB::preparedQuery(
      'SELECT COUNT(*) FROM complementos',
      []
    )[0][0];
  }
}
?>