<?php
class Request{
  public function __get($name){
    if(empty($_POST[$name])){
      Response::setStatusCode(400, 'parameter name not exist');
      throw new Exception("parameter $name not exist");
    }else
      return $_POST[$name];
  }

  public function asArray(){
    $array = [];
    foreach(func_get_args() as $name)
      $array[$name] = $this->{$name};
    return $array;
  }
}
?>
