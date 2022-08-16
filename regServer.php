<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
 session_start();
 require_once "linkSQL.php";

 $login = $_POST['login'];
 $password = $_POST['password'];
 $password_check = $_POST['password_check'];

 if($password === $password_check){
  //Проверка на существование пользователя в БД перед записью
  $chech_us = "SELECT login, password FROM tb_signin WHERE login = :login AND password = :password";
  $statement = $connection->prepare($chech_us);
  $us = [
   'login' =>  $login,
   'password' => $password
  ];
  $statement->execute($us);
  $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
  if(count($result) === 0){

  $tb_users = "INSERT INTO tb_signin(login, password)VALUES (:login, :password)";
  $data = [
   'login' => $login,
   'password' => $password
  ];
  $statement = $connection->prepare($tb_users);
  $result = $statement->execute($data);
  $_SESSION['warn'] = "Авторизация прошла успешно";
  header('Location: log.php');
  }
  else{
   $_SESSION['warn'] = "Пользователь с таким логином или паролем существует";
   header('Location: register.php');
  }
 }else{
  $_SESSION['warn'] = "Введённые пароли не совпадают";
  header('Location: register.php');
 }
}