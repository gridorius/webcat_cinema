<?php
include_once 'main.php';
include_once 'cn.php';
$data = $_POST['data'];
if(!empty($data)){
  $data = json_decode($data);
  $login = $data->login;
  $password = $data->password;

  if(hasUser($login, $password)){
    $token = uniqid(rand(1, 100), true);
    $prepare = $pdo->prepare("UPDATE `users` SET user_token = ? WHERE user_login = ? and user_password = ?");
    $prepare->execute([$token, $login, md5($password)]);
    status(200, 'successful authorization');
    echo json_encode(['token' => $token]);
  }else{
    status(401, 'bad authorization data');
    echo json_encode(['error' => 'bad authorization data']);
  }
}else{
  status(400, 'no data');
}

?>
