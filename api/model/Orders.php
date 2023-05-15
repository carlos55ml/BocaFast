<?php
require_once __DIR__ . '../DB.php';

class Orders {
  public static function countAllActiveOrders() {
    return DB::preparedQuery(
      "SELECT COUNT(*) FROM pedidos WHERE estado='recibido' OR estado='en proceso'",
      []
    )[0][0];
  }

  public static function getAllOrders() {
    return DB::preparedQuery(
      "SELECT * FROM pedidos",
      []
    );
  }
  public static function getOrderById($orderId) {
    return DB::preparedQuery(
      "SELECT * FROM pedidos WHERE id=?",
      [$orderId]
    );
  }
  public static function getAllActiveOrders() {
    return DB::preparedQuery(
      "SELECT pedidos.*, users.username FROM pedidos 
      INNER JOIN users 
      ON pedidos.id_usuario=users.id 
      AND (pedidos.estado='recibido' 
      OR pedidos.estado='en proceso')",
      []
    );
  }
  public static function getAllFinishedOrders() {
    return DB::preparedQuery(
      "SELECT pedidos.*, users.username FROM pedidos 
      INNER JOIN users 
      ON pedidos.id_usuario=users.id 
      AND (pedidos.estado='cancelado' 
      OR pedidos.estado='terminado')",
      []
    );
  }

  public static function cancelOrder($orderId) {
    return DB::preparedQuery(
      "UPDATE pedidos SET estado='cancelado'
      WHERE id=?",
      [$orderId]
    );
  }
  public static function deleteOrder($orderId) {
    return DB::preparedQueryDelete(
      "DELETE FROM pedidos WHERE id=?",
      [$orderId]
    );
  }
  public static function changeOrderState($orderId, $state) {
    $newState = $state == 1 ? 'en proceso' : 'terminado';
    return DB::preparedQuery(
      "UPDATE pedidos SET estado=? WHERE id=?",
      [$newState, $orderId]
    );
  }
}
?>