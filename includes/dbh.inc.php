<?php

$dbServername = "us-cdbr-iron-east-03.cleardb.net";
$dbUsername = "b33d5cd28969e5";
$dbPassword = "12b55fbf";
$dbName = "heroku_abaa9da41503b16";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die('Connection failed: '.mysqli_connect_error());
    }