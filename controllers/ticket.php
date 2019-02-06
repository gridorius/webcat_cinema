<?php
class ticket{
  public function get(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('ticket');
    Response::write($table->select());
  }
}
?>
