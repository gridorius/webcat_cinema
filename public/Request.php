<?php
class Request{
  public function __get($name){
    if(empty($_POST[$name]))
      throw new Exception('parameter not exist');
    else
      return $_POST[$name];
  }
}
?>
