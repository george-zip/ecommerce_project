<?php

function require_auth()
{
    $AUTH_USER = 'johnadmin';
    $AUTH_PASS = 'pancake';

    header('Cache-Control:no-cache');

//Only someone knowing the mysql login username
    $has_supplied_credentials = !((empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW'])) ||
        (isset($_SESSION["Role"]) && $_SESSION["Role"]==2));
    $is_not_authenticated = (
        !$has_supplied_credentials ||
        $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
        $_SERVER['PHP_AUTH_PW'] != $AUTH_PASS
    );
    if ($is_not_authenticated) {
        header('HTTP/1.1 401 Authorization Required');
        header('WWW-Authenticate: Basic realm="Access denied');
        exit;
    }
}

require_auth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Administration</title>
    <link rel="stylesheet" href="css/register-page.css">
</head>
    <body>
        <main id="main-holder">
            <h2 class="text-center">User Administration</h2>
            <form id="login-form" action="adminUsersCode.php" method="POST">
                <div class="form-group">
                <select required name="role" class="form-control" placeholder="Select Role">
                    <option value="disabled selected hidden">Select User Type</option>
                    <option value="employee">Employee</option>
                    <option value="owner">Owner</option>
                    <option value="admin">Admin</option>
                </select>
                </div>

                <div class="form-group">
                    <input type=text" name="email" class="
                    form-control" placeholder="Enter Email">
                </div
                <div class="form-group">

                    <input type=text" name="ssn" class="
                    form-control" placeholder="Enter Social Security Number">
                </div>

                <div class="form-group">

                    <input type="date" name="hiredate" class="
                    form-control" placeholder="Enter Hire Date">
                </div>

                <div class="form-group">

                    <input type=text" name="salary" class="
                    form-control" placeholder="Enter Salary">
                </div>

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
                    <input type="submit" name="btnUserAdmin" class="btn-primary" value="Create User">

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
                    elseif ($_GET['message'] == "badsalary") {
                        //$value = $_GET['message'];
                        echo "Salary amount is not available";
                    }
                    elseif ($_GET['message'] == "badrole") {
                        //$value = $_GET['message'];
                        echo "Please select a valid role";
                    }
                }
            ?>
        </main>
    </body>
</html>
