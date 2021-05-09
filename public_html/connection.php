<?php

// TODO: Move these params into configuration file
$server="localhost:3306";
$user="e_commerce";
$password="e_commerce";
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