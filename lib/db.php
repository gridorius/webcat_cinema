<?php
class DB{
  private $conection;
  public function __construct($database, $login, $password){
    $this->connection = new PDO("mysql:dbname=$database;host=localhost", $login, $password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function table($table_name){
    return new Table($table_name, $this);
  }

  public function executeRetObjects($query, $args){
    return $this->execute($query, $args)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function execute($query, $args){
    $prepare = $this->connection->prepare($query);
    if(!$prepare->execute($args))
      throw new Exception('bad query');;
    return $prepare;
  }
}
?>
