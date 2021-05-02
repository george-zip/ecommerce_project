<?php
//include "loginCode.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Login</title>
  </head>
  <body>
  <main id="main-holder">
    <h2 class="text-center">Login</h2><hr/>
    <form action="loginCode.php" method="POST">
      <div class=form-group">
        <label>Username</label>
        <input type="text" name="email" class="form-control" placeholder="Enter Email">
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
  </main>
  </body>
</html>