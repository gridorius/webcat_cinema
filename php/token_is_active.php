<?php
  include_once 'main.php';
  include_once 'cn.php';

  $token = $_GET['token'];
  echo hasToken($token);
?>
