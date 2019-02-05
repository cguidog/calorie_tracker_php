<?php

    $dbServername = "ec2-50-17-193-83.compute-1.amazonaws.com";
    $dbUsername = "hrxggcqgxerymf";
    $dbPassword = "acff4a35b581ab707bd737d296694a000849bb1afd01ce7c6424499d9c5155c6";
    $dbName = "d647434183tl2q";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die('Connection failed: '.mysqli_connect_error());
    }