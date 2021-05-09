<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drum Center World</title>
    <link rel="stylesheet" type="text/css" href="css/home-styles.css"/>
<!--    <link rel="preconnect" href="https://fonts.gstatic.com">-->
</head>
<body>
<nav id="navigationbar">
    <div>
        <ul>
            <li><a href="index.php"> <img src= "images/logo.png" alt = "Drum Center World"></a></li>
            <li><a href="index.php">Home </a></li>
            <?php


            if (isset($_SESSION["LoginUser"])){
                echo  "<li><a href='Logout.php'>Logout</a></li>";
            }
            else
            {
                echo "<li><a href='Login.php'>Login</a></li>";
                echo "<li><a href='Register.php'>Register</a></li>";
            }
            //if (isset($_SESSION['AdminLogged']) && $_SESSION['AdminLogged'] == true){
 //           if (isset($_SERVER['PHP_AUTH']){
 //                   echo "<li><a href='AdminUsers.php'>Administration</a></li>";
 //           }
//            else {
//                echo "<li><a href='LoginAdmin.php'>Administration</a></li>";
 //           }
// if (isset($_SERVER['PHP_AUTH_USER']) ){
//     $temp = "value= " . $_SERVER['PHP_AUTH_USER'];
//     echo "<li>$temp<li>";
 //}
            ?>
            <li><a href='AdminUsers.php'>Administration</a></li>

        </ul>
    </div>
</nav>
<div class="homeMenu"></div>