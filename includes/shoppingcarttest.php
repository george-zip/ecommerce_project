<?php
session_start();


    if(isset($_POST["add_to_cart"])) {
        //$item_array = array();
        if (isset($_SESSION["shoppingcart"])) {
            $item_array_id = array_column($_SESSION["shoppingcart"], "item_id");
            if(!in_array($_POST["productid"],$item_array_id )){


                $blnValue=CheckInventory();
                    if ($blnValue==true) {

                        $count = count($_SESSION["shoppingcart"]);

                        $a = $_POST["productid"];
                        $b = $_POST["productdescr"];
                        $f = $_POST["productprice"];
                        $g = $_POST["productquantity"];
                        $c = array("item_id" => $a, "description" => $b,
                            "price" => $f, "quantity" => $g);  //shopping cart
                        array_push($_SESSION['shoppingcart'], $c); // Items added to cart  //add item to cart
                        header("Location: ../public_html/Category1.php?message=addedtocart");
                        exit();
                    }
                    else {
                        header("Location: ../public_html/Category1.php?message=outofstock");
                        exit();
                    }

echo $blnValue;

            }
            else{
                header("Location: ../public_html/Category1.php?message=alreadyincart");
                exit();
            }
        }
        else {  //if cart is empty create session array

            $blnValue=CheckInventory();
            echo $blnValue;
            if ($blnValue==true) {
                $_SESSION['shoppingcart'] = array(array(
                    "item_id" => $_POST["productid"],
                    "description" => $_POST["productdescr"],
                    "price" => $_POST["productprice"],
                    "quantity" => $_POST["productquantity"]));
                header("Location: ../public_html/Category1.php?message=addedtocart");
                exit();
            }
            else {
                header("Location: ../public_html/Category1.php?message=outofstock");
                exit();
            }
        }

    }
function CheckInventory()
    //Checks if there is inventory to fulfill the order
{
    include_once '../public_html/connection.php';
    $query = "SELECT AvailableQty  FROM product WHERE ProductID=" . $_POST["productid"] . ";";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "Add to cart failed";
    } else
    {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
       if ($row["AvailableQty"] >= $_POST["productquantity"]){

               return true;

       }
       else {
           return false;
       }
    }
}
?>
