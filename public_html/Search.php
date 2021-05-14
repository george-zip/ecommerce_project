<?php
include_once 'heading.php';

if (!isset($_SESSION['UserID'])) {
    echo 'User must be logged in to search inventory';
} else {
    echo "
<br/><br/><br/><br/>
<!-- <form id='login-form' action='editAccountCode.php' method='POST'> -->
<form class='input-group' style='margin: 20px' method='POST' action='searchCode.php'>
  <div class='form-outline' >
    <input type='search' id='search' name='search-term' class='form-control' placeholder='Search terms' />
  </div>
  <p>
      <input type='submit' class='w3-button w3-section w3-blue w3-ripple' name='btnSearch' value=' Search '>
  </p>
    ";
}

if (isset($_GET['message'])) {
    if ($_GET['message'] == 'error') {
        echo '<h4>An error occurred. Please try your search again.</h4>';
    }
}

echo "</form>";

?>

</body>

</html>