<?php

    $host="127.0.0.1";
    $user='root';
    $pass='';
    $dbname="4event";

    //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    //$db = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass", $pdo_options);
    $db = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
    $db->query("SET NAMES UTF8");
?>

