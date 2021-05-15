<?php
session_start();

$cart = $_POST['cart'];
$cart = json_decode($cart);

$final_cart = array();
foreach($cart as $item) {
    $tmp = array("item_id" => $item[0], "description" => $item[1], "price" => $item[2], "quantity" => $item[3]);
    array_push($final_cart, $tmp);
}


if(isset($_SESSION['shoppingcart'])) {
    $old_cart = $_SESSION['shoppingcart'];
    $_SESSION['shoppingcart'] = array_merge($old_cart, $final_cart);
} else {
    $_SESSION['shoppingcart'] = $final_cart;
}


?>