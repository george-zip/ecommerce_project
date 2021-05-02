<?php
session_start();  //enables setting up session variables
require_once "connection.php";

if(isset($_POST["btnLogin"])) {  //check if user accessed page correctly
    $email = $_POST["email"];
    $password = $_POST["password"];

   //$query = "SELECT * FROM users Where Username='$username' AND Password='$password'";
   $query = "SELECT * FROM users Where Email='$email'";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $message = "valid Username or Password";
        while ($row = mysqli_fetch_assoc($result)) {
            $hashPassword=$row["UserPassword"];   //retrieve hashed password from database
            $validatedPassword = password_verify($password,$hashPassword);   //return true or false
            if ($row["RoleID"] == 2 && $validatedPassword===true) {
                $_SESSION['AdminUser'] = $row["Email"];
                $_SESSION['Role'] = $row["RoleID"];
                header('Location:admin.php');


            } else if ($row["RoleID"] == 1 && $validatedPassword===true){
                $_SESSION['LoginUser'] = $row["Email"];
                $_SESSION['Role'] = $row["RoleID"];
                header('Location:user.php');
            }
            else {
                header("location:Login.php");  //the user entered the wrong password.
            }
        }
    } else {
        $message = "Invalid Username or Password";
        header('Location: Login.php');
        exit();
    }
}
