<?php
class Session{
  public function get(){
    $table = DB::session();
    return $table->select();
  }

  public function getConflicts(){
    return new Collection(DB::executeRetObjects(SESSION_CONFLICTS, []));
  }

  public function getBigTimeouts(){
    return new Collection(DB::executeRetObjects(BIG_TIMEOUT, []));
  }

  public function timeAndMoney(){
    return new Collection(DB::executeRetObjects(TIME_AND_MONEY, []));
  }
}
?>
