<?php

    //Defining Connection Parameters
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','coperman');
    define('DB','forms');

//Establishing Connection With PDO
    try {
        /*$conn = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASSWORD);*/
        $conn = new PDO("sqlite:products.sqlite3");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }
    catch(PDOException $e){
        echo "There was an error while connecting.<br>";
        echo "Error information:<br>";
        echo "Error Message: <strong>{$e->getMessage()}</strong><br>";
        echo "Error Code: <strong>{$e->getCode()}</strong><br>";
        echo "File Name: <strong>{$e->getFile()}</strong><br>";
        echo "Line Number: <strong>{$e->getLine()}</strong><br>";

    }


?>