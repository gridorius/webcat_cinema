<?php
function status($code, $status){
  header("HTTP/1.0 $code $status");
}

function hasUser($login, $password){
  global $pdo;
  $prepare = $pdo->prepare('select * from users where user_login = ? and user_password = ?');
  $prepare->execute([$login, md5($password)]);
  return $prepare->rowCount() > 0;
}

function getRole($token){
  global $pdo;
  $prepare = $pdo->prepare('select user_role as role from users where user_token = ?');
  $prepare->execute([$token]);
  echo var_dump($prepare->fetch());
  return $prepare->fetch()['role'];
}

function hasToken($token){
  global $pdo;
  return $pdo->query("select * from users where user_token = '$token'")->rowCount() > 0;
}

function any_empty(){
  foreach(func_get_args() as $val)
    if(empty($val))
      return true;
  return false;
}
?>
