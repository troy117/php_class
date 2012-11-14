<?php

    require_once DOCUMENT_ROOT . "utils/Connections.php";

    //MySQL Credentials
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $database = "apitest";
    

    
    Connections::$MYSQL = mysqli_connect($host, $user,$pass,$database);

?>