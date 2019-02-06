<?php

class Home{
  public function index(Request $r, $id){
    Response::view('home.html');
  }
}

?>
