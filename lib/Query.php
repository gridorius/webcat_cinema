<?php
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

    $query = 'UPDATE '.$this->table->name.' SET '.join(', ', $params).' WHERE '.$this->where;
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
    $query = 'SELECT '.$this->params.' FROM '.$this->table->name.' WHERE '.$this->where;
    return $this->db->executeRetObjects($query, $values);
  }
}

class Delete extends Query{
  public function execute(){
    $query = 'DELETE FROM '.$this->table->name.' WHERE '.$this->where;
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
