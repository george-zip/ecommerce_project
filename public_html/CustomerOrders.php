<?php
include "connection.php";
include_once'heading.php';

//get customer orders and order details

if (isset($_SESSION["LoginUser"]) && isset($_SESSION["Role"]) && isset($_SESSION["UserID"])
    && $_SESSION["Role"]==1 ) {

    $userID=$_SESSION["UserID"];

    $result = mysqli_query($conn, "SELECT customerorder.OrderID, items.ProductID, 
       product.Description,items.OrderQty,product.Price, 
       Items.OrderQty*product.Price as Total 
        From users,customer,customerorder,items,product 
        where users.UserID='$userID' and users.UserID = Customer.CustomerID and 
              Customerorder.OrderID=items.OrderID and items.ProductID=product.ProductID order by Customerorder.OrderID;");
    $all_property = array();  //declare an array for saving property

//show properties
    echo '<table class="data-table">
        <tr class="data-headers">';
    while ($property = mysqli_fetch_field($result)) {
        echo '<td>' . $property->name . '</td>';  //fields for heading
        array_push($all_property, $property->name);  //save to array
    }
    echo '</tr>';

//showing all data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($all_property as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
        }
        echo '</tr>';
    }
    echo "</table>";
}

else {
    echo "Sorry...No orders found";
}
?>

</body>