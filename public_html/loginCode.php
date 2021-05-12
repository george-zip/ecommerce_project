<?php
session_start();  //enables setting up session variables
require_once "connection.php";

const OWNER_ROLE = 4;
const EMPLOYEE_ROLE = 3;
const ADMIN_ROLE = 2;
const CUSTOMER_ROLE = 1;

if (isset($_POST["btnLogin"])) {  //check if user accessed page correctly
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (missinglogindata($email, $password,) !== false)  //check for missing form data
    {
        header("location:login.php?message=missinglogin"); //send message
        exit();
    }

    if (checkEmail($email) !== false)  //check email
    {
        header("location:login.php?message=erroremailformat"); //send message
        exit();
    }

    //$query = "SELECT * FROM users Where Username='$username' AND Password='$password'";
    //$query = "SELECT * FROM users Where Email='$email'";

    $qry = "SELECT * from users WHERE email = ?;";

    $value = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($value, $qry)) {  //check if query failed
        mysqli_stmt_close($value);
       header("location:login.php?message=badquery"); //send message
        exit();
    }

    mysqli_stmt_bind_param($value, "s", $email);

    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);

    $row = mysqli_fetch_assoc($result);
    if ($row) {

        $hashedPassword = $row["UserPassword"]; //get password returned from query
        echo  nl2br("password in db  $hashedPassword\n");
        $userPassword1 = password_verify($password, $hashedPassword); //returns boolean
        echo  nl2br("password entered $password\n");
        echo  nl2br("password boolean $userPassword1\n");
        if (!$userPassword1) {
            mysqli_stmt_close($value);
            echo "passwords don't match";
            header("location:login.php?message=emailBad"); //send message
            exit();
        }

        $_SESSION['UserID'] = $row['UserID'];

        if ($row["RoleID"] == ADMIN_ROLE) {
            $_SESSION['AdminUser'] = $row["Email"];
            $_SESSION['Role'] = $row["RoleID"];
            //header('Location:admin.php');
            header('Location:index.php');

        } else if ($row["RoleID"] == CUSTOMER_ROLE) {
            $_SESSION['LoginUser'] = $row["Email"];
            $_SESSION['LoginUserId'] = $row["UserID"];  //needed to create order
            $_SESSION['Role'] = $row["RoleID"];
            $_SESSION['Name'] = $row["FirstName"]." ".$row["LastName"];
            //header('Location:user.php');
            header('Location:index.php');
        }

        else if ($row["RoleID"] == EMPLOYEE_ROLE) {
            $_SESSION['LoginUser'] = $row["Email"];
            $_SESSION['Role'] = $row["RoleID"];
            //header('Location:employee.php');
            header('Location:index.php');
        }

        else if ($row["RoleID"] == OWNER_ROLE) {
            $_SESSION['LoginUser'] = $row["Email"];
            $_SESSION['Role'] = $row["RoleID"];
           // header('Location:owner.php');
            header('Location:index.php');
        }
        mysqli_stmt_close($value);
    } else {
        header("location:login.php?message=emailBad");
        exit();
    }
}

function missinglogindata($email, $password)
    //check is email and password contain values
{
    if (empty($email) || empty($password)) {
        return true; //user submitted with missing log in fields
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

