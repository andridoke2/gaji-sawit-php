<?php
    $host = "localhost";
    $dbname = "gajiSawitPHP";
    $username = "root";
    $password = "";
    try {
        $con = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
?>