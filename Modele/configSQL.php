<?php

    $host="127.0.0.1";
    $user='root';
    $pass='';
    $dbname="4event";

    $db = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
    $db->query("SET NAMES UTF8");
?>

