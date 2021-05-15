<?php
include_once 'heading.php';

if (isset($_SESSION['LoginUser'])) {

 echo'   
  <h1>Drum Center World Catalog Search</h1>

  <form action="SearchResults.php" method="post">
        Choose Search Type:<br />
    <select name="searchtype">
      <option value="description">Description
      <option value="ProductId"> Product ID
    </select>
    <br />
    Enter Search Term:<br />
    <input name="searchterm" type="text" size="40">
    <br />
    <input type="submit" name="submit" value="Search">
  </form>

</body>
</html>
    ';

}

else {

}
?>