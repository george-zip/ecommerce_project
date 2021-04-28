<?php
//include "code.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Login</title>
  </head>
  <body>
    <h2 class="text-center">Login</h2><hr/>
    <form action="code.php" method="POST">
      <div class=form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter User Name">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type = "password" name="password" class="
        form-control" placeholder="Enter Password">
      </div>
      <p class="text-center" style="color:red;"></p>



      </p>
      <div class="form-group">
        <input type="submit" name="btnLogin" class="btn
        btn-primary" value="Login">

      </div>
    </form>

  </body>
</html>