<?php

$conn = mysqli_connect("localhost:3306","root","","john");


if($conn)
{
    echo "Connection Successful";
}

else{
    die("Connection Unsuccesful: " . mysqli_connect_error());
}