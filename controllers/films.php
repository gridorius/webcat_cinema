<?php
class Films{
  public function get(){
    $table = DB::film();
    return $table->select()->params('name', 'duration');
  }

  public function add(Request $r){
    $name = $r->name;
    $duration = $r->duration;
    return '';
  }
}
?>
