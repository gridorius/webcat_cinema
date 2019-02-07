<?php
class Home{
  public function index(){
    return view('authorization.html');
  }

  private function admin(){
    return view('admin.html');
  }

  public function auth(Request $r){
    if($r->login == 'admin' && $r->password == '123')
      return $this->admin();
    else
      return $this->index();
  }

  public function test(){
    $table = DB::film();
    $rows = $table->delete()->where("name = 'film26'")->execute();
  }
}

?>
