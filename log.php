<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks5</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- форма авторизации -->
        <form name="log" action="signin.php" method="post" >
        <a class="exit" href="index.php">X</a>
            <h1>Авторизация:</h1>
            <?php
            if(isset($_SESSION['warn'])){
                echo '<p class="massage"> ' . $_SESSION['warn'] . ' </p>';
            }
            unset($_SESSION['warn']);
            ?> 
            <label for="login">Логин</label>
            <input required name="login" type="text">
            <label for="password">Пароль</label>
            <input required name="password" type="password">
            <input type="submit">
            <p>У вас ешё нет аккаунта? - <a href="register.php">Зарегистрируйтесь!</a></p>
        </form>
</body>
</html>
