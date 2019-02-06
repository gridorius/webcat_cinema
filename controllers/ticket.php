<?php
class Ticket{
  public function get(){
    $table = DB::ticket();
    return$table->select();
  }
}
?>
