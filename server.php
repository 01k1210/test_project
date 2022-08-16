<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
 session_start();
 require_once "linkSQL.php";

$name = $_POST['name'];
$inn = $_POST['inn'];
$about = $_POST['about'];
$gen_dir = $_POST['director'];
$adress = $_POST['adress'];
$tel = $_POST['telephone'];

//Проверка на существование записи в БД и запись компании в БД

$check_bd = "SELECT inn, adress, telephone  FROM tb_company WHERE inn = :inn AND adress = :adress AND telephone = :telephone";
$statement = $connection->prepare($check_bd);
$data = [
 'inn' => $inn,
 'adress' => $adress,
 'telephone' => $tel
];
$statement->execute($data);
$result =  $statement->fetchAll(PDO::FETCH_ASSOC);

if(count($result) === 0){
 $tb_company = "INSERT INTO tb_company(name, inn, about, director, adress, telephone) VALUES (:name, :inn, :about, :director, :adress, :telephone)";
 $data = [ 
  'name' => $name,
  'inn' => $inn,
  'about' => $about,
  'director'=> $gen_dir,
  'adress'=> $adress,
  'telephone' => $tel,
 ];
 $statement = $connection->prepare($tb_company);
 $result = $statement->execute($data);
 $_SESSION['message'] = "Компания успешно добавлена";
 header('Location: index.php');
}
else{
 $_SESSION['message'] = "Компания уже существует";
 header('Location: index.php');
}

}
