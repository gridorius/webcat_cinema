<?php
include_once 'Bootstrap.php';

try{
  $urlbase = preg_split('/\//', $_SERVER['REQUEST_URI']);
  $url = [];
  foreach ($urlbase as $val)
    if(!empty($val))
      $url[] = $val;

if(count($url) == 0){
  $controller = new Home();
  $controller->index();
}else{
  $class = new ReflectionClass($url[0]);
  $method = $class->getMethod($url[1]);
  $parameters = $method->getParameters();
  $listParam = [];

  foreach($parameters as $parameter)
    if($parameter->hasType())
      $listParam[] = $parameter->getClass()->newInstance();

  $listParam[] = $url[2];

  $db = new DB('cimena', 'root', '');

  $controller = $class->newInstance();
  $method->invokeArgs($controller, $listParam);
}

}catch(Exception|ReflectionException|PDOException $error){
  Response::addHeader('content-type: application/json');
  // Response::setStatusCode('500', $error->getMessage());
  Response::write(json_encode([
    'error' => $error->getMessage()
  ]));
}
Response::send();




?>
