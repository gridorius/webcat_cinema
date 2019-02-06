<?php
class Ticket{
  public function get(){
    $table = DB::table('ticket');
    Response::write($table->select());
  }
}
?>
