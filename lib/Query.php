<?php
include_once 'Collection.php';
interface Executable
{
  public function execute();
}

class Query implements Executable{
  protected $table;
  protected $db;
  protected $values;
  protected $where = '';

  public function __construct($table){
    $this->table = $table;
    $this->db = $table->getDB();
  }

  public function getWhere(){
    if(empty($this->where))
      return '';
    else return 'WHERE '.$this->where;
  }

  public function __toString(){
    return $this->execute()->__toString();
  }

  public function setValues($array){
    $this->values = $array;
    return $this;
  }

  public function where($text){
    $this->where .= $text;
    return $this;
  }

  public function execute(){

  }
}

class Insert extends Query{
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

class Update extends Query{
  public function execute(){
    $params = [];
    $values = [];

    foreach($this->values as $param => $value){
      $params[] = "$param = ?";
      $values[] = $value;
    }

    $query = 'UPDATE '.$this->table->name.' SET '.join(', ', $params).' '.$this->getWhere();
    $this->db->execute($query, $values);
  }
}

class Select extends Query{
  private $params = '*';

  public function params(){
    $this->params = join(', ', func_get_args());
    return $this;
  }

  public function execute(){
    $query = 'SELECT '.$this->params.' FROM '.$this->table->name.' '.$this->getWhere();
    return new Collection($this->db->executeRetObjects($query, $values));
  }
}

class Delete extends Query{
  public function execute(){
    $query = 'DELETE FROM '.$this->table->name.' '.$this->getWhere();
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
