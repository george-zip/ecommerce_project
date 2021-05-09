<?php

$server="localhost:3306";
$user="root";
$password="";
$database="drumcenterworld";

//need to put this outside the public directory

$conn = mysqli_connect($server,$user,$password,$database);
//mysqli does not use functions.  mysqli replaces mysql

if($conn)
//connection succeeded
{
    echo nl2br("Connection Successful\n");
    echo "";
}

else{
    //display error message
    die("Connection Unsuccesful: " . mysqli_connect_error());
}