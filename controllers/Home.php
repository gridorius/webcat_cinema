<?php

class Home{
  public function index(){
    Response::view('home.html');
  }

  public function test(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('film');
    $rows = $table->delete()->where("name = 'film26'")->execute();
  }
}

?>
