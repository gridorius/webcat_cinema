<?php
class Ticket{
  public function get(){
    $table = DB::ticket();
    Response::write($table->select());
  }
}
?>
