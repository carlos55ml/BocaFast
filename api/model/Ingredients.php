<?php
require_once __DIR__ . '../DB.php';

class Ingredients {
  public static function countAllIngredients() {
    return DB::preparedQuery(
      'SELECT COUNT(*) FROM ingredientes',
      []
    )[0][0];
  }

  public static function getAllIngredients() {
    return DB::preparedQuery(
      'SELECT * FROM ingredientes',
      []
    );
  }

  public static function deleteIngredient($ingredientId) {
    $res = DB::preparedQueryDelete(
      "DELETE FROM ingredientes WHERE id=?",
      [$ingredientId]
    );
    return $res;
  }
}
?>