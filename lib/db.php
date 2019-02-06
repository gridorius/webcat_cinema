<?php
interface Executable
{
  public function execute();
}

class DB{
  private $conection;
  public function __construct($database, $login, $password){
    $this->connection = new PDO("mysql:dbname=$database;host=localhost", $login, $password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function table($table_name){
    return new Table($table_name, $this);
  }

  public function execute($query, $args){
    $prepare = $this->connection->prepare($query);
    return $prepare->execute($args);
  }
}

class Table{
  public $name;
  private $db;

  public function __construct($name, $db){
    $this->name = $name;
    $this->db = $db;
  }

  public function getDB(){
    return $this->db;
  }

  public function insert(){
    return new Insert($this);
  }
}

class Query implements Executable{
  protected $table;
  protected $db;
  public function __construct($table){
    $this->table = $table;
    $this->db = $table->getDB();
  }

  public function execute(){

  }
}

class Insert extends Query{
  private $values;

  public function __construct($table){
    parent::__construct($table);
  }

  public function setValues($array){
    $this->values = $array;
    return $this;
  }

  public function execute(){
    $params = [];
    $values = [];

    foreach($this->values as $param => $value){
      $params[] = $param;
      $values[] = $value;
    }

    $query = 'INSERT INTO '.$this->table->name.' ('.join(', ', $params).') VALUES ('.join(', ', val(count($values))).')';
    $this->db->execute($query, $values);
  }
}

// генерирует массив "?" в требуемом колличестве
function val($count){
  $arr = [];
  for($i = 0;$i<$count;$i++)
    $arr[] = '?';
  return $arr;
}
?>
