<?php
include_once 'Query.php';

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

  public function select(){
    return new Select($this);
  }

  public function update(){
    return new Update($this);
  }

  public function delete(){
    return new Delete($this);
  }
}
?>
