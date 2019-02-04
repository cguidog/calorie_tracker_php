<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <nav class="nav-wrapper">
            <div></div>
            <div class="menu">
                <?php
            if (isset($_SESSION['userId'])) {
                echo '
                <div class="title"><a href="index.php"><h1>Your Calorie Tracker</h1></a></div>
                <div class="menu-buttom"><span class="menu-list-item"><a href="index.php"><i class="fas fa-home"></i></a></span></div>
                <div class="menu-buttom"><span class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></span></div>
                <div class="menu-buttom"><span class="menu-list-item"><a href="history.php"><i class="fas fa-history"></i></a></span></div>
                <div class="menu-buttom">
                <form class="nav-login" action="includes/logout.inc.php" method="POST">
                <button type="submit" name="logout-submit"><i class="fas fa-sign-out-alt"></i></button>
            </form></div>';
            } else {
                echo '<div class="nav-login">
                <form action="includes/login.inc.php" method="POST">
                <input type="text" name="mailuid" placeholder="Username/e-mail">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>';
            }
        ?>
            </div>
            <div></div>
        </nav>
    </header>