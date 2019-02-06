<?php
class Films{
  public function get(){
    $table = DB::film();
    Response::write($table->select()->params('name', 'duration'));
  }

  public function add(Request $r){
    $name = $r->name;
    $duration = $r->duration;

  }
}
?>
