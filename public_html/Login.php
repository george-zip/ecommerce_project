<?php
include_once'heading.php';  //navigation menu will be on all web pages
?>
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
<?php
if (isset($_GET['message'])) {
    if ($_GET['message'] == "missinglogin") {
        echo "Please Provide all values";
    }
    elseif ($_GET['message'] == "erroremailformat") {
        echo "Email is not valid";
    }
    elseif ($_GET['message'] == "emailbad") {
        echo "Email or password is not valid";
    }
}
    ?>
  </main>
  </body>
</html>