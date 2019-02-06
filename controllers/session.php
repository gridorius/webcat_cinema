<?php
class session{
  public function get(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('session');
    Response::write($table->select());
  }
}
?>
