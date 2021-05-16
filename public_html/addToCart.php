<?php
session_start();

$cart = $_POST['cart'];
$cart = json_decode($cart);

$final_cart = array();
foreach($cart as $item) {
    $tmp = array("item_id" => $item[0], "description" => $item[1], "price" => $item[2], "quantity" => $item[3], "available" => $item[4]);
    array_push($final_cart, $tmp);
}

if(isset($_SESSION["shoppingcart"])) {
    $old_cart = $_SESSION["shoppingcart"];
    foreach($final_cart as $item_to_add) {
        $found = false;
        foreach ($old_cart as $item_in_cart) {
            if($item_to_add["item_id"] == $item_in_cart["item_id"]) {
                $available = intval($item_to_add["available"]);
                $desired = intval($item_in_cart["quantity"]) + intval($item_to_add["quantity"]);
                $item["quantity"] = min($available, $desired);
                $found = true;
                break;
            }
        }
        if($found == false) {
            array_push($old_cart, $item_to_add);
        }
    }
    $_SESSION['shoppingcart'] = $old_cart;
} else {
    $_SESSION['shoppingcart'] = $final_cart;
}

?>