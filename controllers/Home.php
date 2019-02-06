<?php

class Home{
  public function index(){
    Response::view('home.html');
  }

  public function test(){
    $db = new DB('cimena', 'root', '');
    $table = $db->table('film');
    $table->insert()->setValues(['name' => 'film6', 'duration' => '60'])->execute();
  }
}

?>
