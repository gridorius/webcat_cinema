<?php
include_once 'main.php';
include_once 'cn.php';
include_once 'isAdmin.php';

$name = $_POST['name'];
$duration = $_POST['duration'];

if(!any_empty($name, $duration)){
  $prepare_film = $pdo->prepare('insert into film values(null, ?, ?)');
  $prepare_film->execute($name, $duration);
}
?>
