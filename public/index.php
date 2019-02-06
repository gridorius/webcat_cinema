<?php
include_once 'Bootstrap.php';
include_once 'Response.php';
include_once 'Request.php';
try{
  $urlbase = preg_split('/\//', $_SERVER['REQUEST_URI']);
  $url = [];
  foreach ($urlbase as $val)
    if(!empty($val))
      $url[] = $val;

$class = new ReflectionClass($url[0]);
$method = $class->getMethod($url[1]);
$parameters = $method->getParameters();
$listParam = [];
foreach($parameters as $parameter)
  if($parameter->hasType())
    $listParam[] = $parameter->getClass()->newInstance();
$listParam[] = $url[2];
$controller = $class->newInstance();
$method->invokeArgs($controller, $listParam);

}catch(Exception|ReflectionException $error){
  Response::addHeader('content-type: application/json');
  Response::setStatusCode('400', $error->getMessage());
  Response::write(json_encode([
    'error' => $error->getMessage()
  ]));
}
Response::send();




?>
