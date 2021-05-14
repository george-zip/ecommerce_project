<?php
session_start();
if(isset($_SESSION['LoginUser']) && isset($_POST["btn-order"]) && isset($_SESSION['Role']) && $_SESSION['Role']==1);
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
            //Get the available
            $query = "SELECT AvailableQty  FROM product WHERE ProductID=" . $id . ";";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo nl2br("Inventory sql statement failed\n";
            }
            else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                $QtyAvail = $row["AvailableQty"] - $qty;
                $query = "UPDATE product SET AvailableQty = $QtyAvail WHERE ProductID=" . $id . ";";
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    echo nl2br("Inventory adjusted\n";
                } else {
                    mysqli_stmt_execute($stmt);
                }
            }
        }
        //Clear the shopping cart
        unset($_SESSION["shoppingcart"]);
        echo nl2br("Order items created successfully\n";
    }

}
function GenerateOrder($conn,$custID1)
{
    //Generate the order from items in the shopping cart
    //insert record into customerorder table
    $query = "INSERT INTO customerorder (CustomerID,LastUpdate) VALUES ('$custID1', '2021-05-08')";
    if (mysqli_query($conn, $query)) {
        echo nl2br("Order created successfully\n";
        echo '<a href="index.php">Home</a>';
        return true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_connect_error($conn);
        return false;
    }
}

?>


