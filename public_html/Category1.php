<?php
include_once'heading.php';  //navigation menu will be on all web pages
//echo $_SESSION['LoginUser'];
    if(!isset($_SESSION['LoginUser'])){
        //A user must be logged in to see this page
        header("location:Login.php");
        exit();
    }
?>

<main>
    <link rel="stylesheet" href="css/category-style.css">
    <section class="category-links">
        <div class="wrapper">

            <h2>Category 1</h2>
            <div class= "category-container">
        <!--     start here -->
                <?php
                include_once 'connection.php';
                          $query = "SELECT * FROM product;";  //26:16
                            $stmt=mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$query)){
                                echo "Flex Box Query failed";
                            }
                            else {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result)) { //display all products

                                    echo '
                                                <a href="#">
                                                <form action="../includes/shoppingcarttest.php" method="POST">
                                                <div width="25px" style="background-image: url(images/category/' . $row["PhotoLink"] . ');"></div>
                                                <h3>' . $row["Category"] . '</h3>
                                                <input type="text" name="productid" value="'. $row["ProductID"] . '">
                                                <input type="text" name="productdescr" value="'. $row["Description"] . '">
                                                <input type="text" name="productprice" value="'. $row["Price"] . '">
                                                <input type="text" name="productquantity" value="'. $row["AvailableQty"] . '">
                                                <input type="submit" name="add_to_cart" value="Add To Cart">
                                                </form>
                                                </a>
                                      ';

                                }
                            }
                            ?>
        <!--     end here -->

    </div>
        </div>

        <?php
        //echo "Session ".$_SESSION['Role'];
        if (isset($_SESSION['Role']) && ($_SESSION['Role']==3 || $_SESSION['Role']==4)){
            echo '<div class="category-upload">
                    <form action="../includes/category-upload.inc.php" method="POST" enctype="multipart/form-data">
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


<table margins="10px" style="width:25%"  border="1px solid black"  border-collapse="collapse">
    <tr>
        <th>Item ID</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
    </tr>
<?php

    if(!empty($_SESSION["shoppingcart"])){
        //print_r($_SESSION["shoppingcart"]);

        $total = 0;  //total value of shopping cart
        foreach($_SESSION["shoppingcart"] as $keys=>$values){
           // echo $values["item_id"];
           // print_r($values["item_id"]);

?>
<tr>
    <td><?php echo $values["item_id"]; ?>
    <td><?php echo $values["description"]; ?>
    <td align="right">$<?php echo number_format($values["price"],2); ?>
    <td align="right"><?php echo $values["quantity"]; ?>
    <td align="right">$<?php echo number_format($values["quantity"] * $values["price"],2); ?>
</tr>

    <?php
            $total = $total + ($values["quantity"] * $values["price"]);
    }}
?>
    <tr>
        <td colspan="4" align ="right">Total</td>
        <td align="right">$<?php echo number_format($total,2); ?></td>
    </tr>
</table>

<div class="wrapper">
    <footer>
        <ul>
<!--            <li></li>-->
        </ul>
    </footer>
</div>
</body>
</html>