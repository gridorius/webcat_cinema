<?php
class Home{
  public function index(){
    return view('home.html');
  }

  public function admin(){
    return view('admin.html');
  }

  public function test(){
    $table = DB::film();
    $rows = $table->delete()->where("name = 'film26'")->execute();
  }
}

?>
