<?php
session_start();
//if (isset($_POST['submit2'])) {
    $prodID = $_POST["productid"];
    $prodID2 = (integer) $prodID;
    $prodPrice = $_POST["productprice"];
    $productQuantity = $_POST["productquantity"];

    include_once '../public_html/connection.php';
    //check if product being deleted has been ordered
    //don't delete if the product has been ordered
    $qry = "SELECT * FROM items WHERE ProductID=?;";


    $value = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($value, $qry)) {  //check if query failed
        mysqli_stmt_close($value);
        header("location:login.php?message=badquery"); //send message
        exit();
    }



    mysqli_stmt_bind_param($value, "i", $prodID2);
    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);
    $row = mysqli_fetch_assoc($result);

    if ($row>0) {
        $qry = "SELECT * FROM product WHERE ProductID=?;";
        $value = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($value, $qry)) {  //check if query failed
            mysqli_stmt_close($value);
            header("location:login.php?message=badquery"); //send message
            exit();
        }
        mysqli_stmt_bind_param($value, "i", $prodID2);
        mysqli_stmt_execute($value);
        $result = mysqli_stmt_get_result($value);
        $row = mysqli_fetch_assoc($result);


        if ($prodPrice!==$row["Price"]) {
            //orders exist for this product, cancel modification
            $query = "Update product Set AvailableQty='$productQuantity' Where ProductID = '$prodID2';";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo "error in query";
            }
            else
            {
                mysqli_stmt_execute($stmt);
                echo "Quantity updated - prices can not be changed if previously ordered";
                header("Location: ../public_html/CategoryModify.php?message=quantmodified");
                exit();
            }
        }

    }
    else {
        //modifyproduct($prodID, $prodPrice, $productQuantity);

        $query = "Update product set price='$prodPrice',AvailableQty='$productQuantity' Where ProductID = '$prodID2';";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "error in query";
        }
        else {
            mysqli_stmt_execute($stmt);
            header("Location: ../public_html/CategoryModify.php?message=modified");
            exit();
        }
    }
//}
//else{
//        header("Location: ../public_html/CategoryModify.php?invalidentry");
//    }


?>