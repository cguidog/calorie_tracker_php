<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_GET['item']) && isset($_GET['calories'])) {
    
    require 'dbh.inc.php';


    $item = $_GET['item'];
    $calories = $_GET['calories'];
    $favorite = 0;

        $sql = "INSERT INTO items (idUser, item, calories, favorite, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../newitem.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "isiis", $_SESSION['userId'], $item, $calories, $favorite, date("Y-m-d"));
            mysqli_stmt_execute($stmt);

            header("Location: ../index.php?result=success");
            exit();
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
    header("Location: ../signup.php");
    exit();
}