<?php
session_start();
require_once "connection.php";

if ($conn == false) {
    //print message and exit current script
    die("Connection failed: " . mysqli_connect_error());
}

//check is user navigated from Register form
//if not load the register page
//if (isset($_POST["btnUserAdmin"]) && isset($_SESSION["AdminLogged"]) &&
//    $_SESSION["AdminLogged"] != false) {


if (isset($_POST["btnUserAdmin"])) {//&& isset($_SESSION["AdminLogged"]) &&
    //$_SESSION["AdminLogged"] != false) {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $role = $_POST["role"];
    if (trim($role)=="employee" ){
        $role = 3;
    }
    else if (trim($role)=="owner" ){
        $role = 4;
    }
    else if (trim($role)=="admin" ){
        $role = 2;
    }

    $salary = $_POST["salary"];
    $ssn = $_POST["ssn"];
    $hiredate = $_POST["hiredate"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];

    //require_once 'dbh.inc.php'; //48.57
    //require 'functions.inc.php';

    // echo $username,$password,$email,$firstname,$lastname,$street,$city,$state,$zip;

    //check to see if form is complete
    if (missingRegData($email, $password, $firstname, $lastname, $street, $city,
            $state, $zip, $ssn, $salary) !== false)  //check for missing form data
    {
        header("location:adminUsers.php?message=missingRegister"); //send message
        exit();
    }


    if (checkSalary($salary) != false) {
        header("location:AdminUsers.php?message=badsalary"); //send message
        exit();
    }

    if (checkEmail($email) !== false)  //check email
    {
        header("location:adminUsers.php?message=errorEmail"); //send message
        exit();
    }

    if (checkEmailExists($email) !== false)  //check if account already exists
    {
        header("location:adminUsers.php?message=emailExists"); //send message
        exit();
    }

    if (checkRole($role) !==false){  ////check that user input a valid role
        header("location:adminUsers.php?message=$role"); //send message
        exit();
    }

    //not currently implemented
//    if (checkDate(($hiredate) !==false){  ////check that user input a valid role
//        header("location:adminUsers.php?message=badrole"); //send message
//        exit();
 //   }

//If form data is ok create the user in the db
    $query1 = "INSERT INTO users(UserID,RoleID,FirstName,LastName,Email,
                   Street,City,StateAbbreviation,ZipCode,UserPassword) VALUES 
                    (NULL,'$role','$firstname','$lastname','$email','$street','$city','$state','$zip','$password')";
    mysqli_begin_transaction($conn);  //create user in db
    try {
        //1:21:14
        mysqli_query($conn, $query1);  //populate user table
        //if (mysqli_query($conn,$query1)){
        $last_id = mysqli_insert_id($conn);  //retrieves auto increment table value
        echo $last_id;
        $query2 = "INSERT INTO employee (EmployeeID,SSN,HireDate,Salary) VALUES
                    ('$last_id','$ssn','$hiredate','$salary')";
        mysqli_query($conn, $query2); //populate employee table
        mysqli_commit($conn);
        echo "New account created successfully";
        header("location:Login.php");  //if successful proceed to login page
    }
        //if (mysqli_query($conn,$query2)){
        //   echo "New User created successfully";//}

    catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        echo "New User not created successfully";
        header("location:AdminUserssss.php");
//        //throw $e;
    }
} else if (!isset($_POST["btnUserAdmin"])) {
    //user did not access this page through AdminUsers_old.php
    header("location:AdminUserssss.php");
    exit();
}

else{
    //user did not provide server login credentials
    header("location:LoginAdmin.php");
    exit();
}


function missingRegData($email, $password, $firstname, $lastname, $street, $city,
                        $state, $zip, $ssn,$salary)
{
    if (empty($email) || empty($password) || empty($firstname) || empty($lastname)
        || empty($street) || empty($city) || empty($zip) || empty($ssn) || empty($salary)) {
        return true;
    } else {
        return false;
    }
}

function checkEmail($email)
    //checks if email format is valid
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
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
    if (!mysqli_stmt_prepare($value, $qry)) {  //check if query failed
        header("location:AdminUsers.php?message=emailBad"); //send message
        exit();
    }


    mysqli_stmt_bind_param($value, "s", $email);

    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);


    if ($row = mysqli_fetch_assoc($result)) {  //fetches a result row as an array
        //return $row;  //user exists
        return true;
    } else {
        return false;  //user doesn't exist
    }

    mysqli_stmt_close($value);
}

function checkSalary($salary)
    //check for that a valid salary was input
{
    //Check that salary is a number
    $salaryVal = (float)$salary;
    if ($salaryVal == 0) {
        return true;
    }
    else
        return false;
}

function checkRole($role)
{
//check that user submitted a valid role
    switch ($role) {
        case 1:
            //$usertype = 1;
            return false;
            break;
        case 3:
           // $usertype = 3;
            return false;
            break;
        case 4:
            //$usertype = 4;
            return false;
            break;
        case 2:

            return false;
            break;
        default:
           return true;
            break;
    }
}

//function checkDate()
    //page 347
    //date checking not implemented yet
//{
    //check that user entered a valid date
//    $mmddyy = explode('/', $_POST['departure_date']);
//    if (count($mmddyy) != 3) {
//        echo "ERROR: Invalid Date specified!";
//        exit;
 //   }
// handle years like 02 or 95
//    if ((int)$mmddyy[2] < 100) {
//        if ((int)$mmddyy[2] > 50) {
//            $mmddyy[2] = (int)$mmddyy[2] + 1900;
//        } else if ((int)$mmddyy[2] >= 0) {
//            $mmddyy[2] = (int)$mmddyy[2] + 2000;
//        }
// else it's < 0 and checkdate will catch it
//    }
    //if (!checkdate($mmddyy[0], $mmddyy[1], $mmddyy[2])) {
        //echo "ERROR: Invalid Date specified!";
    //}
//}

//Note paramaterized queries preven sql injection by separating code from data
