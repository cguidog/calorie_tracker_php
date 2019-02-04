<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_POST['item-submit'])) {
    
    require 'dbh.inc.php';


    $item = strtoupper($_POST['item']);
    $calories = $_POST['calories'];
    $favorite = $_POST['favorite'];

    if (empty($item) || empty($calories)) {

        header("Location: ../newitem.php?error=emptyfields&item=".$item."&calories=".$calories);
        exit();

    } else if (!preg_match("/^[a-z A-Z0-9]*$/", $item)) {
        
        header("Location: ../newitem.php?error=invalidcharacters&calories=".$calories);
        exit();

    } else if (!preg_match("/^[0-9]*$/", $calories)) {

        header("Location: ../newitem.php?error=invalidcharacters&item=".$item);
        exit();

    } else {
        
        if ($_POST['favorite'] == 1) {

            $favorite = $_POST['favorite'];

        } else {
            $favorite = 0;
        }

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

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../signup.php");
    exit();
}