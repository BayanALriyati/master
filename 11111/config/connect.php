<?php

$host = 'localhost';
$database= 'gifts';
$username='root';
$password='';

// Creating database connection
$con= mysqli_connect($host , $database , $username , $password);

// Check database connection
try {
    echo 'You Are Connected Welcome To Database';
}catch (Exception $e){
    $error = $e->getMessage();
    echo $error;
}

// try {
//     $con= new PDO($server, $user, $pass, $option);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
//     echo 'You Are Connected Welcome To Database';
// }

// catch(Excepion $error){
//     echo 'Failed To Database' . $error->getMessage();
// }


?>