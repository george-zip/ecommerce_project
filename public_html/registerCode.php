<?php
session_start();
require_once "connection.php";

if ($conn==false) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["btnRegister"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    $email=$_POST["email"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $street=$_POST["street"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $zip=$_POST["zip"];

    $paymentmethod=$_POST["billingmethod"];

   // echo $username,$password,$email,$firstname,$lastname,$street,$city,$state,$zip;


    $query1 = "INSERT INTO users (UserID,Email,UserPassword,RoleID,FirstName,LastName,Street,City,StateAbbreviation,ZipCode) VALUES (NULL,'$email','$password',1,'$firstname','$lastname','$street','$city','$state','$zip')";
    mysqli_begin_transaction($conn);
    try {
        mysqli_query($conn, $query1);
        //if (mysqli_query($conn,$query1)){
        $last_id = mysqli_insert_id($conn);
        echo $last_id;
        $query2 = "INSERT INTO customer (CustomerID,JoinDate,BillingMethod) VALUES ($last_id,'2021-05-08','$paymentmethod')";
        mysqli_query($conn, $query2);
        mysqli_commit($conn);
        echo "New User created successfully";
        header("location:Login.php");
    }
        //if (mysqli_query($conn,$query2)){
         //   echo "New User created successfully";//}

    catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        echo "New User not created successfully";
        header("location:Register.php");
        //throw $e;
    }
   // }


//else  {
//    //user did not access this page through Register.php
//    //header("location:Register.php");
//    echo "New User not created successfully";
//    exit();
//    }
}