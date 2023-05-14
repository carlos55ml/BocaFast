<?php
require_once __DIR__ . '../DB.php';

class Orders {
  public static function countAllActiveOrders() {
    return DB::preparedQuery(
      "SELECT COUNT(*) FROM pedidos WHERE estado='recibido'",
      []
    )[0][0];
  }
}
?>