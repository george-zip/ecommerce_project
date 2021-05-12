<?php
session_start();
if(isset($_SESSION['LoginUser']) && isset($_POST["btn-order"]))
    //if(isset($_POST["btn-order"]))
{
    //Check if shopping cart is empty before processing an order
    $custID = $_SESSION['LoginUserId'];
    $custID1 = (int)$custID;
    if (!empty($_SESSION["shoppingcart"])) {
        require_once "../public_html/connection.php";  //open the database and add records
        //Get the customer id using the email addresss of the user
        $addOrderResult = GenerateOrder($conn, $custID1);
        if ($addOrderResult == false) {
            exit();
        }
        $last_id = mysqli_insert_id($conn);
        foreach ($_SESSION["shoppingcart"] as $keys => $values) {
            $id = (int)$values["item_id"];
            $qty = (int)$values["quantity"];

            $query = "INSERT INTO items (OrderID,ProductID,OrderQty) VALUES ($last_id, $id, $qty)";
            if (!mysqli_query($conn, $query)) {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                exit();
            }
        }
        //Clear the shopping cart
        unset($_SESSION["shoppingcart"]);
        echo "Order items created successfully";
    }

}
function GenerateOrder($conn,$custID1)
{
    //insert record into customerorder table
    $query = "INSERT INTO customerorder (CustomerID,LastUpdate) VALUES ('$custID1', '2021-05-08')";
    if (mysqli_query($conn, $query)) {
        echo "Order created successfully";
        return true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_connect_error($conn);
        return false;
    }
}




