<?php

// TODO: Move these params into configuration file
$server="localhost:3306";
$user="e_commerce";
$password="e_commerce";
$database="drumcenterworld";

$conn = mysqli_connect($server,$user,$password,$database);

if(!$conn)
{
    die("Connection Unsuccessful: " . mysqli_connect_error());
}