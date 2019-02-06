<?php
class Session{
  public function get(){
    $table = DB::table('session');
    Response::write($table->select());
  }
}
?>
