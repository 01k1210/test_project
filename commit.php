<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 require_once "linkSQL.php";
 date_default_timezone_set( 'Europe/Moscow' );
 $com_us = $_POST['commit'];
 $today = date('d-m-Y H:i:s'); 
 $us_com =  $com_us . ' ' . $today;

 $tb_commit = "INSERT INTO tb_commit(commit, dt) VALUES (:commit, :dt)";
  $data = [
   'commit' => $com_us,
   'dt' =>   $today
  ];
  $statement = $connection->prepare($tb_commit);
  $result = $statement->execute($data);
  echo  $us_com;
}
