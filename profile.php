<?php
session_start();
require_once "linkSQL.php";

if(isset($_GET['del'])){
    $id = $_GET['del'];
    $del = "DELETE FROM tb_company WHERE id = $id";
    $res = $connection->exec($del);
    if($res){
        $_SESSION['message'] = "Компания успешно удалена";
    }
}

$link_bd = $connection ->prepare("SELECT * FROM tb_company");
$link_bd->execute();
$arrays = $link_bd->fetchAll(PDO::FETCH_ASSOC);

if(!$_SESSION['user']){
    header('Location: register.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Главная страница</title>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="col-md-12">
    <?php
            if(isset($_SESSION['message'])){

                echo '<div class="alert alert-warning mt-3" role="alert">
                <p class="massage text-center"> ' . $_SESSION['message'] . ' </p>
              </div>';
            }
            unset($_SESSION['message']);
            ?> 
        <div class="row align-items-center">
            <div class="col-md-10">
                <h5>Вы вошли под Логином: <?=$_SESSION['user']['login']?></h5>
            </div>
            <div class="col-md-2">
            <a class="btn btn-primary" href="index.php" role="button">Выйти с учётной записи</a>
            </div>
        </div>
    </div>

 <div class="col-md-12">
    <div class="row">
    <?php foreach($arrays as $array): ?>
        <div class="card-wrap col-md-4 mt-3">
            <div class="card border border-primary p-2">

                <div class="wrap col-md-12">
                    <div class="row">
                    <h5 class="col-md-10" class="card-title">Компания: <?=$array['name']?></h5>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>


                <div class="wrap col-md-12">
                    <div class="row">
                    <p class="card-text col-md-10">О компании: <?=$array['about']?></p>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>

                <div class="wrap col-md-12">
                    <div class="row">
                    <p class="card-text col-md-10">ИНН: <?=$array['inn']?></p>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>

                <div class="wrap col-md-12">
                    <div class="row">
                    <p class="card-text col-md-10">Директор компании: <?=$array['director']?></p>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>

                <div class="wrap col-md-12">
                    <div class="row">
                    <p class="card-text col-md-10">Адресс компании: <?=$array['adress']?></p>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>

                <div class="wrap col-md-12">
                    <div class="row">
                    <p class="card-text col-md-10">Телефон: <a href="tel:<?=$array['telephone']?>"><?=$array['telephone']?></a></p>
                    <i data-action="open" class="fa fa-plus-square-o col-md-2"></i>
                    </div>
                </div>

            <a class="btn btn-primary" href="?del=<?=$array['id']?>" role="button">Удалить</a>
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