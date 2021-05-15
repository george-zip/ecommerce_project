<?php
include_once'heading.php';  //navigation menu will be on all web pages
//echo $_SESSION['LoginUser'];
    if(!isset($_SESSION['LoginUser'])){
        //A user must be logged in to see this page
        header("location:Login.php");
        exit();
    }
    if(isset($_GET["action"])) {  //category to be retrieved
        $_SESSION["CategoryModifyVal"]=$_GET["action"];
    }

    else if (!isset($_SESSION["CategoryModifyVal"])){
        //go back to home so user can select a category
        header("location:index.php");
        exit();
    }


?>

<main>
    <link rel="stylesheet" href="css/category-style.css">
    <section class="category-links">
        <div class="wrapper">

            <h2>Category <?php echo $_SESSION["CategoryModifyVal"];?></h2>
            <div class= "category-container">
                <?php
                include_once 'connection.php';
                          //retrieve and display inventory when user navigates to product page
                //only display add to cart if the user is a customer
                if (isset($_SESSION['Role']) && ($_SESSION['Role']==3)) {
                    $query = "SELECT * FROM product WHERE Category=" . $_SESSION["CategoryModifyVal"] . ";";  //26:16


                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        echo "Flex Box Query failed";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while ($row = mysqli_fetch_assoc($result)) { //display all products
                            //show the product fields from database in text boxes
                            //when a user adds a product add it to the shopping cart
                            echo '
                                <a href="#">
                                <form action="../includes/deleteinventory.inc..php" method="POST">
                                <div width="25px" style="background-image: url(images/category/' . $row["PhotoLink"] . ');"></div>
                                <h3>' . $row["Description"] . '</h3>
                                <input type="hidden" name="productid" value="' . $row["ProductID"] . '">
                                <input type="hidden" name="productdescr" value="' . $row["Description"] . '">
                                <input type="text" name="productprice" value="' . $row["Price"] . '">
                                <input type="hidden" name="filenames" readonly value="' . $row["PhotoLink"] . '">
                                <input type="text" style="margin-top:4px" name="productquantity" min="1" placeholder="Quantity">
                                <input style="margin-top:10px; margin-bottom:10px" type="submit" name="submit" value="Delete Item">
                                

                             </form>
                                </a>  ';
                        }
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == "modified") {
                                //$value = $_GET['message'];
                                echo "<p>Product quantity modified</p>";
                            }
                            if ($_GET['message'] == "invalidentry") {
                                //$value = $_GET['message'];
                                echo "<p>Select item to be modified</p>";
                            }
                            if ($_GET['message'] == "cantmodify") {
                                //$value = $_GET['message'];
                                echo "<p>Ordered products can not be modified</p>";
                            }
                        }
                    }
                }
                            ?>

    </div>
        </div>



    </section>
</main>







<div class="wrapper">
    <footer>
        <ul>
<!--            <li></li>-->
        </ul>
    </footer>
</div>
</body>
</html>