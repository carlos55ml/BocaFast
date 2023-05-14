<?php
require_once __DIR__ . '../DB.php';

class Pieces {
  public static function countAllPieces() {
    return DB::preparedQuery(
      "SELECT COUNT(*) FROM piezas_definidas",
      []
    )[0][0];
  }
}
?>