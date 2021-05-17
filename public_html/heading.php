<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drum Center World</title>
    <link rel="stylesheet" type="text/css" href="css/home-styles.css"/>
    <!-- if you remove the below script, it will break the ability to add to the cart from the search screen -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav id="navigationbar"">
    <div class="container-fluid">

        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION["LoginUser"])) {
                echo "<li><a href='Logout.php'>Log Out</a></li>";
                if (isset($_SESSION["Role"]) && $_SESSION["Role"] == 1) {
                    echo "<li><a href='Search.php'>Search Inventory</a></li>";
                    echo "<li><a href='EditAccount.php'>Edit Account</a></li>";
                    echo "<li><a href='CustomerOrders.php'>Show Orders</a></li>";
                    echo "<li><a href='Checkout.php'>Cart</a></li>";
                    echo "<li><a href='Register.php'>Register</a></li>";
                }
            if (isset($_SESSION["Role"]) && $_SESSION["Role"] == 4) {


            }
                if (isset($_SESSION["Role"]) && $_SESSION["Role"] == 4) {
                    echo "<li><a href='indexDelete.php'>Delete Product</a></li>";
                    echo "<li><a href='indexModify.php'>Modify Product</a></li>";
                }

            } else {
                echo "<li><a href='Login.php'>Log In</a></li>";

            }
            if (isset($_SESSION["Role"]) && $_SESSION["Role"] == 3){
                echo "<li><a href='indexDelete.php'>Delete Product</a></li>";
                echo "<li><a href='indexModify.php'>Modify Product</a></li>";
            }
            ?>

            <li><a href='AdminUsers.php'>Administration</a></li>"

        </ul>
    </div>
</nav>

<?php
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

