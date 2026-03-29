<?php
$isDocker = getenv('MYSQL_HOST') !== false;

if ($isDocker) {
    $db_host = getenv('MYSQL_HOST');
    $db_user = getenv('MYSQL_USER');
    $db_pass = getenv('MYSQL_PASSWORD');
    $db_name = getenv('MYSQL_DATABASE');
} else {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '235689';
    $db_name = 'consultorio';
}

$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conexion){
    echo "Error: " . mysqli_connect_error();
    exit;
}
