<?php
class Session{
  public function get(){
    $table = DB::session();
    return $table->select();
  }
}
?>
