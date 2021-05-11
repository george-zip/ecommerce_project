<?php
session_start();
//session_unset();
//session_destroy();
    if(isset($_POST["add_to_cart"])) {
        //$item_array = array();
        if (isset($_SESSION["shoppingcart"])) {
            $item_array_id = array_column($_SESSION["shoppingcart"], "item_id");
            if(!in_array($_POST["productid"],$item_array_id )){
                $count = count($_SESSION["shoppingcart"]);
//                $item_array=array (
//                    'item_id'=>$_POST["productid"],
//                    "description" => $_POST["productdescr"],
//                    "price" => $_POST["productprice"]
                $a=$_POST["productid"];
                $b=$_POST["productdescr"];
                $f=$_POST["productprice"];
                $g=$_POST["productquantity"];
                $c=array("item_id"=>$a,"description"=>$b,"price"=>$f,"quantity"=>$g);  //shopping cart
                array_push($_SESSION['shoppingcart'],$c); // Items added to cart  //add item to cart


                //$_SESSION["shoppingcart"][$count] = $item_array;
                header("Location: ../public_html/Category1.php?message=added]");
                exit();
            }
            else{
                header("Location: ../public_html/Category1.php?message=alreadyincart");
                exit();
            }
        }
        else {  //if cart is empty create session array
//            $item_array['id'] = array(
//                "item_id" => $_POST["productid"],
//                "description" => $_POST["productdescr"],
//                "price" => $_POST["productprice"]
//            );
            $_SESSION['shoppingcart']=array (array(
                "item_id" => $_POST["productid"],
                "description" => $_POST["productdescr"],
                "price" => $_POST["productprice"],
                "quantity" => $_POST["productquantity"]));
            header("Location: ../public_html/Category1.php?message=addedtocart0");
            exit();
        }

    }
