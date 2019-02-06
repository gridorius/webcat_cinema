<?php
class Films{
  public function get(){
    $table = DB::film();
    return $table->select()->params('name', 'duration');
  }

  public function add(Request $r){
    $params = $r->asArray('name', 'duration');
    DB::film()->insert()->setValues($params)->execute();
  }
}
?>
