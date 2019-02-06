<?php
class Home{
  public function index(){
    Response::view('home.html');
  }

  public function admin(){
    Response::view('admin.html');
  }

  public function test(){
    $table = DB::film();
    $rows = $table->delete()->where("name = 'film26'")->execute();
  }
}

?>
