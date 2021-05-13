<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drum Center World</title>
    <link rel="stylesheet" type="text/css" href="css/home-styles.css"/>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Drum Center World</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION["LoginUser"])) {
                echo "<li><a href='Logout.php'>Log Out</a></li>";
                echo "<li><a href='Checkout.php'>Cart</a></li>";
                if (isset($_SESSION["Role"]) and $_SESSION["Role"] == 1) {
                    echo "<li><a href='EditAccount.php'>Edit Account</a></li>";
                } else {
                    echo "<li><a href='AdminUsers.php'>Administration</a></li>";
                }
            } else {
                echo "<li><a href='Login.php'>Log In</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>