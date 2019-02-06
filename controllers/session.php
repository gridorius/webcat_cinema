<?php
class Session{
  public function get(){
    $table = DB::session();
    Response::write($table->select());
  }
}
?>
