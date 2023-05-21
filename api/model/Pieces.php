<?php
require_once __DIR__ . '../DB.php';

class Pieces {
  public static function countAllPieces() {
    return DB::preparedQuery(
      "SELECT COUNT(*) FROM piezas_definidas",
      []
    )[0][0];
  }
  public static function getAllPieces() {
    return DB::preparedQuery(
      "SELECT * FROM piezas_definidas",
      []
    );
  }
  public static function getPieceById($pieceId) {
    return DB::preparedQuery(
      "SELECT * FROM piezas_definidas WHERE id=?",
      [$pieceId]
    );
  }
  public static function saveNewPiece($nombreBocata, $ingredientesBocata, $precioBocata, $descripcionBocata, $imagenUrl) {
    return DB::preparedQuery(
      "INSERT INTO piezas_definidas(nombre, ingredientes, precio, imagen, descripcion) VALUES (?, ?, ?, ?, ?)",
      [$nombreBocata, $ingredientesBocata, $precioBocata, $imagenUrl, $descripcionBocata]
    );
  }
}
?>