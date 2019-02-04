<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_POST['date-submit'])) {
    require 'dbh.inc.php';
    $date = $_POST['date'];
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM items WHERE date= ? AND IdUser= ?;";
    $stmt = mysqli_stmt_init($conn);

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <title>Document</title>
    </head>
    <body>
        <header>
        <nav class="nav-wrapper">
                <div></div>
                    <div>';
                    if (isset($_SESSION['userId'])) {
                        echo '<a href="../index.php"><h1>Calorie Tracker</h1></a>
                        <ul class="menu-list">
                        <li class="menu-list-item"><a href="../index.php"><i class="fas fa-home"></i></a></li>
                        <li class="menu-list-item"><a href="../newitem.php"><i class="fas fa-plus"></i></a></li>
                        <li class="menu-list-item"><a href="../history.php"><i class="fas fa-history"></i></a></li>
                    </ul>
                <form class="nav-login" action="logout.inc.php" method="POST">
                <button type="submit" name="logout-submit"><i class="fas fa-sign-out-alt"></i></button>
            </form>';
                    } else {
                        echo '<form action="includes/login.inc.php" method="POST">
                        <input type="text" name="mailuid" placeholder="Username/e-mail">
                        <input type="password" name="pwd" placeholder="Password">
                        <button type="submit" name="login-submit">Login</button>
                    </form>
                    <a href="signup.php">Signup</a>';
                    }
    echo '
    </div>
</div>
</nav>
</header>';
        if (empty($date)) {

    header("Location: ../history.php?error=emptyfields");
    exit();
        } else if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("Location: ../index.php?error=sqlerror");
        exit();

    } else {

        mysqli_stmt_bind_param($stmt, "ss", $date, $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
            

                if ($result->num_rows > 0) {
                    $dtotal = 0;
                    foreach($result as $row) {
                        $dtotal += $row["calories"];
                    }

                    echo '<div class="details">
                            <div class="detail-title">
                                <div><h3>'. $date.' detail</h3></div>
                                <div><p>Calorie Total</br>'. $dtotal.'</p></div>
                                <div><span class="menu-list-item"><a href="../index.php"><i class="fas fa-home"></i></a></span></div>
                            </div>';
                    foreach ($result as $row) {
                        echo "<p> Item: ". $row["item"]. " - Calories: ". $row["calories"].  "</p>";
                    }
                    echo '</div>';
                } else {
                    echo '<div class="details"><p>0 results</p></div>';
                    exit();
                    
                }
}
} else {
    header("Location: ../index.php");
    exit();
}