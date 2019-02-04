<?php
session_start();
require 'dbh.inc.php';
$userId = $_SESSION['userId'];
//New Limit
if (isset($_POST['limit-submit'])) {

    $limit = $_POST['limit'];

    if (empty($limit)) {

        header("Location: ../index.php?error=emptyfields");
        exit();

    } else if (!preg_match("/^[0-9]*$/", $limit)) {

        header("Location: ../index.php?error=invalid");
        exit();

    } else {

        $sql = "INSERT INTO limits (idUser, limits) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "ii", $_SESSION['userId'], $limit);
            mysqli_stmt_execute($stmt);

            header("Location: ../index.php?result=success");
            exit();
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    
} else if (isset($_POST['limit-update'])) {

    $limit = $_POST['limit'];

    if (empty($limit)) {

        header("Location: ../index.php?error=emptyfields");
        exit();

    } else if (!preg_match("/^[0-9]*$/", $limit)) {

        header("Location: ../index.php?error=invalid");
        exit();

    } else {

        $sql = "UPDATE limits SET limits=? WHERE idUser=$userId;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "i", $limit);
            mysqli_stmt_execute($stmt);

            header("Location: ../index.php?result=success");
            exit();
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
