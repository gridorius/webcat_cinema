<?php
class films{
  public function get(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('film');
    Response::write($table->select());
  }
}
?>