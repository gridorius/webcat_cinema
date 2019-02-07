<?php
class Films{
  public function get(){
    return new Collection(DB::executeRetObjects(GET_FILMS_INFO, []));
  }

  public function add(Request $r){
    $params = $r->asArray('name', 'duration');
    DB::film()->insert()->setValues($params)->execute();
  }
}
?>
