<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_GET['id'])) {
    
    require 'dbh.inc.php';

    $itemId = $_GET['id'];

        $sql = "UPDATE items SET favorite=0 WHERE itemId =?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "i", $itemId);
            mysqli_stmt_execute($stmt);

            header("Location: ../favorites.php?result=success");
            exit();
        }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../signup.php");
    exit();
}