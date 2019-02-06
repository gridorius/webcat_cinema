<?php
include_once 'cn.php';
include_once 'main.php';

$token = preg_replace('/Bearer /', '', getallheaders()['Authorization']);
if(getRole($token) != 1){
  status(401, 'you are not admin');
  exit();
}
?>
