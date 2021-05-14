<?php
include_once'heading.php';  //navigation menu will be on all web pages
//echo $_SESSION['LoginUser'];
    if(!isset($_SESSION['LoginUser'])){
        //A user must be logged in to see this page
        header("location:Login.php");
        exit();
    }
    if(isset($_GET["action"])) {  //category to be retrieved
        $_SESSION["CategoryVal"]=$_GET["action"];
    }

    else {
        //go back to home so user can select a category
        header("location:index.php");
        exit();
    }
    //echo "Session Category: " .$_SESSION['CategoryVal'];

?>

<main>
    <link rel="stylesheet" href="css/category-style.css">
    <section class="category-links">
        <div class="wrapper">

            <h2>Category <?php echo $_SESSION["CategoryVal"];?></h2>
            <div class= "category-container">
                <?php
                include_once 'connection.php';
                          //retrieve and display inventory when user navigates to product page
                //only display add to cart if the user is a customer
                if (isset($_SESSION['Role']) && ($_SESSION['Role']==1)) {
                    $query = "SELECT * FROM product WHERE Category=" . $_SESSION["CategoryVal"] . ";";  //26:16


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
                                <form action="../includes/shoppingcarttest.php" method="POST">
                                <div width="25px" style="background-image: url(images/category/' . $row["PhotoLink"] . ');"></div>
                                <h3>' . $row["Description"] . '</h3>
                                <input type="hidden" name="productid" value="' . $row["ProductID"] . '">
                                <input type="hidden" name="productdescr" value="' . $row["Description"] . '">
                                <input type="text" name="productprice" readonly value="' . $row["Price"] . '">
                                <input type="number" style="margin-top:4px" name="productquantity" min="1" placeholder="Quantity">
                                <input style="margin-top:10px; margin-bottom:10px" type="submit" name="add_to_cart" value="Add To Cart">
                                

                             </form>
                                </a>  ';
                        }
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == "alreadyincart") {
                                //$value = $_GET['message'];
                                echo "<p>already added to Cart</p>";
                            }
                            if ($_GET['message'] == "addedtocart") {
                                //$value = $_GET['message'];
                                echo "<p>Added to Cart</p>";
                            }
                            if ($_GET['message'] == "outofstock") {
                                //$value = $_GET['message'];
                                echo "<p>Out of Stock</p>";
                            }
                        }
                    }
                }
                            ?>

    </div>
        </div>

        <?php
        //if the logged in user is an employee, display form to add items.
        //user will type the product description
        if (isset($_SESSION['Role']) && ($_SESSION['Role']==3 || $_SESSION['Role']==4)){
            echo '<div class="category-upload">
                    <form action="../includes/category-upload.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="category" value="';

        //echo $_GET["action"];  //get the category
            echo $_SESSION["CategoryVal"];  //get the category
            echo '">';
            echo'
                    <input type="text" name="filename" placeholder="File name">
                    <input type="text" name="filetitle" placeholder="Image title">
                    <input type="text" name="filedesc" placeholder="Image description">
                    <input type="text" name="fileprice" placeholder="Item price">
                    <input type="text" name="filequantity" placeholder="Quantity">
                    <input type="file" name="file">
                    <button type="submit" name="submit">UPLOAD</button>
                </form>
            </div>';
        }

        ?>


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