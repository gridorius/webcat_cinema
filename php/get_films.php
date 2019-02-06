<?php
include_once 'cn.php';
include_once 'main.php';
echo json_encode($pdo->query('select * from film')->fetchAll(PDO::FETCH_OBJ));

?>
