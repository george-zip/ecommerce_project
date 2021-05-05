<?php
session_start();
require_once "connection.php";

if ($conn==false) {
    //print message and exit current script
    die("Connection failed: " . mysqli_connect_error());
}

//check is user navigated from Register form
//if not load the register page
if(isset($_POST["btnRegister"])) {
    //$username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $paymentmethod = $_POST["billingmethod"];

    //require_once 'dbh.inc.php'; //48.57
    //require 'functions.inc.php';

    // echo $username,$password,$email,$firstname,$lastname,$street,$city,$state,$zip;

    //check to see if form is complete
    if (missingRegData($email, $password, $firstname, $lastname, $street, $city,
            $state, $zip, $paymentmethod) !== false)  //check for missing form data
    {
        header("location:register.php?message=missingRegister"); //send message
        exit();
    }

    if (checkEmail($email) !== false)  //check email
    {
        header("location:register.php?message=errorEmail"); //send message
        exit();
    }

    if (checkEmailExists($email) !== false)  //check if account already exitst
    {
        header("location:register.php?message=emailExists"); //send message
        exit();
    }

//If form data is ok create the user in the db
    $query1 = "INSERT INTO users (UserID,Email,UserPassword,RoleID,FirstName,LastName,
                   Street,City,StateAbbreviation,ZipCode) VALUES (NULL,'$email',
                '$password',1,'$firstname','$lastname','$street','$city','$state','$zip')";
    mysqli_begin_transaction($conn);  //create user in db
    try {
        //1:21:14
        mysqli_query($conn, $query1);  //populate user table
        //if (mysqli_query($conn,$query1)){
        $last_id = mysqli_insert_id($conn);
        echo $last_id;
        $query2 = "INSERT INTO customer (CustomerID,JoinDate,BillingMethod) VALUES 
                    ($last_id,'2021-05-08','$paymentmethod')";
        mysqli_query($conn, $query2); //populate customer table
        mysqli_commit($conn);
        echo "New User created successfully";
        header("location:Login.php");  //if successful proceed to login page
    }
        //if (mysqli_query($conn,$query2)){
        //   echo "New User created successfully";//}

    catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        echo "New User not created successfully";
        header("location:Register.php");
        //throw $e;
    }
}

else  {
    //user did not access this page through Register.php
    //header("location:Register.php");
    echo "New User not created successfully";
    exit();
}

function missingRegData($email, $password, $firstname, $lastname, $street, $city,
                        $state, $zip, $paymentmethod)
{
    if (empty($email) || empty($password) || empty($firstname) || empty($lastname)
        || empty($street) || empty($city) || empty($zip) || empty($paymentmethod))
    {
        return true;
    }

    else {
        return false;
    }
}

function checkEmail($email)
    //checks if email format is valid
{
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        return true;
    }

    else {
        return false;
    }
}

function checkEmailExists($email)
    //check if account already exists
    //use prepared statements to avoid injection
{
    $qry = "SELECT * from users WHERE email = ?;";
    global $conn;
    $value = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($value,$qry)) {  //check if query failed
        header("location:register.php?message=emailBad"); //send message
        exit();
    }


    mysqli_stmt_bind_param($value,"s",$email);

    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);


    if ($row = mysqli_fetch_assoc($result)) {  //fetches a result row as an array
        //return $row;  //user exists
        return true;
    }
    else {
        return false;  //user doesn't exist
    }

    mysqli_stmt_close($value);
}
