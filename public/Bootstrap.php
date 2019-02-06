<?php
$controllers = glob('../controllers/*');
foreach ($controllers as $controller)
  include_once($controller);
?>
