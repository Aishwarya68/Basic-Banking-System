<?php

$server = "localhost";
$username = "root";
$password ="";
// Create a database connection
$con = new mysqli($server,$username,$password,"bank","3307");

// Check or connection success
if(!$con){
    die("Connection to this database failed due to".mysqli_connect_error());
}

 ?>