<?php
class DB {
  static private $mysqlConnectionString = "mysql:dbname=bocafast;host=127.0.0.1;charset=utf8mb4";
  static private $mysqlUser = "root";
  static private $mysqlPass = "";
  static private $dbo = null;

  /**
   * Connects to the database.
   * Assings DB Object to a new PDObject with the conections details.
   */
  static function connect() {
    try {
      self::$dbo = new PDO(self::$mysqlConnectionString, self::$mysqlUser, self::$mysqlPass);
      self::$dbo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      self::$dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
      self::$dbo = null;
      return ['error' => "$ex"];
    }
  }

  /**
   * Checks if the DB Object is not null.
   * If is connected to DB, will return true
   * @return bool the DB Objects exist (DB Connected)
   */
  static function checkDbConnection() {
    return !is_null(self::$dbo);
  }

  /**
   * Executes a query.
   * @param string $query The query to execute.
   * @return mixed The result, or null if failed.
   */
  public static function query(string $query) {
    if (!self::checkDbConnection()) return null;
    try {
      $result = self::$dbo->query($query);
      return $result;
    } catch (PDOException $ex) {
      return ['error' => "$ex"];
    }
  }

  /**
   * Executes a prepared statment and returns the result.
   * @param string $query The query to prepare.
   * @param array $values The values of the prepared query.
   * @return mixed The result of the query, or null if failed.
   */
  public static function preparedQuery(string $query, array $values) {
    if (!self::checkDbConnection()) return null;
    try {
      $stmt = self::$dbo->prepare($query);
      $stmt->execute($values);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $ex) {
      return ['error' => "$ex"];
    }
  }
  public static function preparedQueryDelete(string $query, array $values) {
    if (!self::checkDbConnection()) return null;
    try {
      $stmt = self::$dbo->prepare($query);
      $stmt->execute($values);
      $result = $stmt->rowCount();
      return $result;
    } catch (PDOException $ex) {
      return ['error' => "$ex"];
    }
  }

  /**
   * Executes a prepared statment and returns the last inser id.
   * @param string $query The query to prepare.
   * @param array $values The values of the prepared query.
   * @return mixed The last insert id, or null if failed.
   */
  public static function preparedQueryRetId(string $query, array $values) {
    if (!self::checkDbConnection()) return null;
    try {
      $stmt = self::$dbo->prepare($query);
      $stmt->execute($values);
      $result = self::$dbo->lastInsertId();
      return $result;
    } catch (PDOException $ex) {
      return ['error' => "$ex"];
    }
  }
}
DB::connect();
?>