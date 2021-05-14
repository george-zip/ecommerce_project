<?php
include_once 'heading.php';  //navigation menu will be on all web pages
?>
<br>
<br>
<div class="w3-container w3-half w3-margin-top">
    <h3 class='text-center'>Please log in</h3>

    <form class="w3-container w3-card-4" action="loginCode.php" method="POST">
        <p>
            <input type="text" name="email" class="w3-input" style="width:90%">
            <label>Email</label>
        </p>
        <p>
            <input type="password" name="password" class="w3-input" style="width:90%">
            <label>Password</label>
        </p>
        <p>
            <input type="submit" class="w3-button w3-section w3-red w3-ripple" name="btnLogin" value=" Log in ">
        </p>
    </form>
</div>
<?php
if (isset($_GET['message'])) {
    if ($_GET['message'] == "missinglogin") {
        echo "Please Provide all values";
    } elseif ($_GET['message'] == "erroremailformat") {
        echo "Email is not valid";
    } elseif ($_GET['message'] == "emailBad") {
        echo "Email or password is not valid";
    } else {
        echo "An unexpected error error occurred";
    }
}
?>
</body>
</html>