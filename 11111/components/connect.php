<?php

$server= 'mysql:host=localhost;dbname=gifts';
$user='root';
$pass='';
$option =array(
    PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$con= new PDO($server, $user, $pass, $option);

// try {
//     $con= new PDO($server, $user, $pass, $option);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
//     echo 'You Are Connected Welcome To Database';
// }

// catch(PDOExcepion $error){
//     echo 'Failed To Database' . $error->getMessage();
// }


?>