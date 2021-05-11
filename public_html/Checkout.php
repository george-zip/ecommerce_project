<?php
//session_start();
include_once'heading.php';  //navigation menu will be on all web pages
?>
<main>
    <form form action="index.php" method="POST">
<table margins="10px" style="width:25%"  border="1px solid black"  border-collapse="collapse">
    <tr>
        <th>Item ID</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Remove</th>
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
                <td><?php echo $values["item_id"]; ?></td>
                <td><?php echo $values["description"]; ?></td>
                <td align="right">$<?php echo number_format($values["price"],2); ?></td>
                <td align="right"><?php echo $values["quantity"]; ?></td>
                <td align="right">$<?php echo number_format($values["quantity"] * $values["price"],2); ?></td>
                <td align="center"><a href="Checkout.php?action=delete&id=<?php echo $values["item_id"];?>">Remove</a></td>
            </tr>

            <?php
            $total = $total + ($values["quantity"] * $values["price"]);
        }}
    ?>
    <tr>
        <td colspan="4" align "right">Total</td>
        <td align="right">$<?php echo number_format($total,2); ?></td>

    </tr>

</table>
        <input type="submit" name="btnLogin" class="btn
        btn-primary" value="Place Order"></td>
    </form>
</main>

</body>
</html>

<?php
if(isset($_GET["action"])){
    echo "got here";
    if($_GET["action"] =="delete")
    {
        foreach($_SESSION["shoppingcart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shoppingcart"][$keys]);
                echo "Item Removed";
                header("Location: ../public_html/Checkout.php?message=removed");
            }
        }
    }
}
?>