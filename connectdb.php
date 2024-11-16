<?php
    // Database connection file allows other files to connect to the database
    // wherever it is included
    $dbhost = "localhost";
    $dbuser= "root";
    $dbpass = "********";
    $dbname = "sitedb";
    $connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
    if (mysqli_connect_errno()) {
        die("database connection failed :" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }
?>
