<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_test";


    try{
        $con = mysqli_connect($host, $username, $password, $dbname);
    }
    catch(mysqli_sql_exception){
        echo "Database Error";
    }

?>