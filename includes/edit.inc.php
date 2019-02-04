<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/New_York');
if (isset($_POST['edit-item-submit'])) {
    
    require 'dbh.inc.php';

    $itemId = $_POST['itemId'];
    $item = $_POST['item'];
    $calories = $_POST['calories'];

    if (empty($item) || empty($calories)) {

        header("Location: ../edit.php?error=emptyfields&item=".$item."&calories=".$calories);
        exit();

    } else if (!preg_match("/^[a-z A-Z0-9]*$/", $item)) {
        
        header("Location: ../edit.php?error=invalidcharacters&calories=".$calories);
        exit();

    } else if (!preg_match("/^[0-9]*$/", $calories)) {

        header("Location: ../edit.php?error=invalidcharacters&item=".$item);
        exit();

    } else {

        $sql = "UPDATE items SET item=?, calories=? WHERE itemId = $itemId";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "si", $item, $calories);
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