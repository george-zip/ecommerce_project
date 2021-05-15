<?php
include_once 'heading.php';
include_once 'connection.php';

echo'<h1>Drum Center World Search Results</h1>';

// create short variable names
$searchtype=$_POST['searchtype'];
$searchterm=trim($_POST['searchterm']);

if (!$searchtype || !$searchterm) {
    echo 'You have not entered search details.  Please go back and try again.';
    exit;
}

$db = new $conn;
$qry = "select * from product where ".$searchtype." like '%".$searchterm."%'";

$result = mysqli_query($conn, $qry);
//$all_property = array();  //declare an array for saving property
//
//while ($property = mysqli_fetch_field($result)) {
//    array_push($all_property, $property->name);  //save to array
//}

echo '<table class="data-table"><tr class="data-headers">';

while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . $row["ProductID"].'</td>';
     if ($row["Category"] ==1) {
           echo '<td> <a href="Category1.php?action=1">Link</a></td>';
        }
     if ($row["Category"]==2) {
            echo ' <td><a href="Category1.php?action=2">Link</a></td>';
        }
     if ($row["Category"]==3){
            echo ' <td><a href="Category1.php?action=3">Link</a></td>';
        }
     if ($row["Category"]==4)  {
            echo ' <td><a href="Category1.php?action=4">Link</a></td>';
        }
    echo '<td>' . $row["Description"] . '</td>'; //get items using property value
    echo '</tr>';
}
echo "</table>";

?>
</body>
</html>