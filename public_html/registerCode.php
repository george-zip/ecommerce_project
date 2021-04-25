<?php
session_start();
require_once "connection.php";

if ($conn==false) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["btnLogin"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    $query = "INSERT INTO users (Username,Password,Role) VALUES ('$username','$password','Customer')";
    if (mysqli_query($conn,$query)){
        echo "New User created successfully";
    }

else  {
    header("location:Register.php");
    exit();
    }
}