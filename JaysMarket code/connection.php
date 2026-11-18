<?php

$db_hostname = 'localhost';
$db_database = 'u471353624_ImadSites';
$db_username = 'u471353624_ImadMustafa';
$db_password = 'Pruss14nSky-';
$conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
