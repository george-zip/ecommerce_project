<?php
include_once 'heading.php';
require_once "connection.php";

if(isset($_POST["btnSearch"])) {

    $searchTerm = $_POST["search-term"];
    $searchTerm = "%" . $searchTerm . "%";
    $query = "select * from Product 
        where (Category like ? or Description like ?)
        and AvailableQty > 0
        order by Category";

    $value = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($value, $query)) {
        mysqli_stmt_close($value);
        header("location:Search.php?message=error"); //send message
        exit();
    }

    mysqli_stmt_bind_param($value, "ss", $searchTerm, $searchTerm);
    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);

    echo "<div style='margin: 20px'>";
    echo "<br/><br/>";
    echo "<br/><table id='search-results' class='table table-bordered'><caption>Search Results</caption>";
    echo "<tread><tr><th scope='col'>#</th>";
    echo "<th scope='col'>Description</th><th scope='col'>Price</th>";
    echo "<th scope='col'>Quantity</th></tr></tread><tbody>";
    $row_num = 1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "<th scope='row'>" . $row_num . "</th>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td id=" . $row['Price'] . ">";
        printf("$%.2f",$row['Price']);
        echo "</td>";
        $productID = $row['ProductID'];
        $available = $row['AvailableQty'];
        echo "<td><input type='number' id=$productID name=$productID placeholder='0' value='0' min=0 max=$available>";
        echo "</td></tr>";
        $row_num++;
    }
    echo "</tbody></table>";
    echo "<form>
            <button type='button' class='w3-button w3-section w3-blue w3-ripple' onclick='addItems()' name='btnSubmit'> Add to cart </button>
          </form>";

    echo "
    <script>
        function addItems() {
            var table = document.getElementById('search-results');
            var cart = [];
            for (var i = 1, row; row = table.rows[i]; i++) {
               var quantity = parseInt(row.cells[3].children[0].value);
               var price = parseFloat(row.cells[2].id);
               var description = row.cells[1].innerHTML;
               var productID = row.cells[3].children[0].id;
               var available = row.cells[3].children[0].max;
               if(quantity > 0) {
                   cart.push([productID, description, price, quantity, available]);
               }
            }
            var elements = JSON.stringify(cart);
            $.post('addToCart.php', {cart: elements});
        }
    </script>";

    echo "</body></html>";
    
}
else {
    header("location:Search.php?message=error");
    exit();
}


