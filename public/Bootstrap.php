<?php
$controllers = glob('../controllers/*');
$lib = glob('../lib/*');
foreach ($controllers + $lib as $file)
  include_once($file);
?>
