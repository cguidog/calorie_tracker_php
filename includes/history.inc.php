<?php

require 'header.inc.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_POST['date-submit'])) {
    require 'dbh.inc.php';
    $date = $_POST['date'];
    $brokenDate = explode("-", $_POST['date']);
    $month = $brokenDate[1];
    $day = $brokenDate[2];
    $year = $brokenDate[0];
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
                                <div><h3>Detail '. $month.'-'. $day.'-'. $year.'</h3></div>
                                <div><h3>Total</h3></div>
                                <div><h3>'. $dtotal.'</h3></div>
                            </div>';
                    foreach ($result as $row) {
                        echo '<div><p>'. $row["item"].'</p></div>';
                        echo "<p>Calories: ". $row["calories"].  "</p>";
                    }
                    echo '</div>';
                } else {
                    echo '<div class="details"><h2><a href="../history.php" >No results</a></h2></div>';
                    exit();
                    
                }
}
} else {
    header("Location: ../index.php");
    exit();
}