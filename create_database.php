<?php

    
    //MySQL Credentials
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $database = "apitest";
    $table = "users";
    //connect to mysql
    class Connection
    {
        public static $MYSQL;
    }
    
    Connection::$MYSQL = mysql_connect($host, $user, $pass);
    
    //create a new database
    $query = sprintf("CREATE DATABASE IF NOT EXISTS %s",$database);
        $result = fancy_query($query);
        
        //select database
        mysql_select_db(Connection::$MYSQL,$database);
        
    //create a table in databse
    $query = sprintf("CREATE TABLE IF NOT EXISTS %s (".
                     "user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, ".
                     "username VARCHAR(250) NOT NULL, ".
                     "password VARCHAR(50) NOT NULL, ".
                     "INDEX (username))", $table);
        
        
        
        
        $result = fancy_query($query);
        
        if($result)
        {
            echo "<h1>Create Table Success!</h1>";
        }
           
        
    function fancy_query($_query)
    {
            $internal_result = mysql_query(Connection::$MYSQL,$_query);
            if(!$internal_result)
            {
                die("Mysql Query Failed: ".mysql_error());
            }
            return $internal_result;
    }
    

?>