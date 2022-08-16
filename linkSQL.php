<?php
$server = '127.0.0.1'; //127.0.0.1
$port = '3306'; 
$username = 'root';
$password = '368la1996';
$db_name = 'sql_lessons';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$connection = new PDO("mysql:host=$server;port=$port;dbname=$db_name",$username,$password,$options);

$tb_company = 'CREATE TABLE IF NOT EXISTS tb_company(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    inn VARCHAR(20),
    about VARCHAR(100),
    director VARCHAR(20),
    adress VARCHAR(100),
    telephone VARCHAR(20)
 );';
$result = $connection->exec($tb_company);

$tb_users = 'CREATE TABLE IF NOT EXISTS tb_signin(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(200) ,
    password VARCHAR(100)
 );';
$res = $connection->exec($tb_users);

$tb_commit = 'CREATE TABLE IF NOT EXISTS tb_commit(
    id INT AUTO_INCREMENT PRIMARY KEY,
    commit VARCHAR(200),
    dt VARCHAR(30)
 );';
$res_commit = $connection->exec($tb_commit);
// if($connection->exec($tb_company) !== false) echo"Таблица  успешно создана";
?>