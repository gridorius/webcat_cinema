<?php
class Ticket{
  public function get(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('ticket');
    Response::write([123]);
  }
}
?>
