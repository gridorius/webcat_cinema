<?php
$controllers = glob('../controllers/*');
$lib = glob('../lib/*');
foreach ($lib as  $lib)
  include_once($lib);
foreach ($controllers as $controller)
  include_once($controller);
?>
