<?php
class DB{
  private static $connection;
  private static $context;
  public function __construct($database, $login, $password){
    static::$connection = new PDO("mysql:dbname=$database;host=localhost", $login, $password);
    static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    static::$context = $this;
  }

  public static function table($table_name){
    return new Table($table_name, static::$context);
  }

  public function executeRetObjects($query, $args){
    return static::execute($query, $args)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function execute($query, $args){
    $prepare = static::$connection->prepare($query);
    if(!$prepare->execute($args))
      throw new Exception('bad query');;
    return $prepare;
  }
}
?>
