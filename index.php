<?php
session_start();
require_once "linkSQL.php";
$link_bd = $connection ->prepare("SELECT * FROM tb_company");
$link_bd->execute();
$arrays = $link_bd->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Главная страница</title>
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="col-md-12">
        <div class="row">
        <?php
            if(isset($_SESSION['message'])){

                echo '<div class="alert alert-warning mt-3" role="alert">
                <p class="massage text-center"> ' . $_SESSION['message'] . ' </p>
              </div>';
            }
            unset($_SESSION['message']);
            ?> 
            <div class="col-md-8">
                <p>Войдите или зарегистрируйтесь чтобы отправлять комментарии</p>
            </div>
            <div class="col-md-4">
            <a class="btn btn-primary" href="register.php" role="button">Зарегистрироваться</a>
            <a class="btn btn-primary" href="log.php" role="button">Авторизироваться</a>
            </div>
        </div>
    </div>

 <div class="col-md-12">
    <div class="row">
    <?php foreach($arrays as $array): ?>
        <div class="card-wrap col-md-3 mt-3">
            <div class="card border border-primary p-2">
            <h5 class="card-title">Компания: <?=$array['name']?></h5>
            <p class="card-text">О компании: <?=$array['about']?></p>
            <p class="card-text">ИНН: <?=$array['inn']?></p>
            <p class="card-text">Директор компании: <?=$array['director']?></p>
            <p class="card-text">Адресс компании: <?=$array['adress']?></p>
            <p>Телефон: <a href="tel:<?=$array['telephone']?>"><?=$array['telephone']?></a></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="col-md-12">
    <div class="card-wrap col-md-12">
        <div class="mb-3 mt-3">
            <button type="button" class="btn btn-primary open">Добавить компанию</button>
        </div>

            <form name="addcompany"  class="border border-primary p-2 d-none" action="server.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="name">Название компании</label>
                    <input class="form-control" required name="name" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inn">ИНН компании</label>
                    <input class="form-control" required name="inn" type="number">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="about">Общая информация</label>
                    <textarea required class="form-control" name="about" rows="3"></textarea>
                    <div></div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="director">Директор</label>
                    <input class="form-control" required name="director" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="adress">Адресс компании</label>
                    <input class="form-control" required name="adress" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="telephone">Телефон компании</label>
                    <input class="form-control" required name="telephone" type="number">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary form-control" type="submit" value="Добавить">
                </div>
            </form>
    </div>
</div>

</div>
<script src="script.js"></script>
</body>
</html>