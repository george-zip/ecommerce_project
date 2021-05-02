<?php

$server="localhost:3306";
$user="root";
$password="";
$database="drumcenterworld";

$conn = mysqli_connect($server,$user,$password,$database);
//mysqli does not use functions.  mysqli replaces mysql

if($conn)
//connection succeeded
{
    echo "Connection Successful";
}

else{
    //display error message
    die("Connection Unsuccesful: " . mysqli_connect_error());
}