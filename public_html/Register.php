<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/register-page.css">
</head>
    <body>
        <main id="main-holder">

            <h2 class="text-center">Register</h2>

            <form id="login-form" action="registerCode.php" method="POST">

                <div class="form-group">
                    <!-- <label>Email</label> -->
                    <input type=text" name="email" class="
                    form-control" placeholder="Enter Email">
                </div
                <div class="form-group">
                    <!-- <label>Password</label> -->
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                </div>

                <div class="form-group">
                    <!-- <label>First Name</label> -->
                    <input type=text" name="firstname" class="
                    form-control" placeholder="Enter First Name">
                </div
                <div class="form-group">
                        <!-- <label>Last Name</label> -->
                        <input type=text" name="lastname" class="form-control" placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                        <!--<label>Street</label> -->
                        <input type=text" name="street" class="form-control" placeholder="Enter Street Address">
                </div>

                <div class="form-group">
                    <!--<label>City</label> -->
                    <input type=text" name="city" class=" form-control" placeholder="Enter City">
                </div>

                <div class="form-group">
                    <!--<label>State</label> -->
                    <input type=text" name="state" class="form-control" placeholder="Enter State">
                </div>

                <div class="form-group">
                    <!-- <label>Zip Code</label>-->
                    <input type=text" name="zip" class="form-control" placeholder="Enter Zip Code">
                </div>



                    <!--<label>Billing Method</label> -->
                <div class="form-group">
                    <select required name="billingmethod" class="form-control" placeholder="Enter Join Date">
                        <option value=""disabled selected hidden>Select Payment Method</option>
                        <option value="amex">American Express</option>
                        <option value="visa">Visa</option>
                        <option value="Discover">Discover</option>
                    </select>
                </div>
                    <input type="submit" name="btnRegister" class="btn-primary" value="Register">

            </form>

            <?php

                if (isset($_GET['message'])) {
                    if ($_GET['message'] == "missingRegister") {
                        //$value = $_GET['message'];
                        echo "Please Provide all values";
                    }
                    elseif ($_GET['message'] == "errorEmail") {
                        //$value = $_GET['message'];
                        echo "Please provide a valid email";
                    }
                    elseif ($_GET['message'] == "emailExists") {
                        //$value = $_GET['message'];
                        echo "Email is not available";
                    }
                }

            ?>
        </main>



    </body>

</html>