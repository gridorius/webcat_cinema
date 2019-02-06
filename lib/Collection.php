<?php
class Collection{
  private $array;

  public function __construct($array){
    $this->array = $array;
  }

  public function __toString(){
    Response::addHeader('content-type: application/json');
    return json_encode($this->array);
  }
}
?>
