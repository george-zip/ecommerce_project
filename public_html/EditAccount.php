    <?php
    include_once 'heading.php';
    session_start();
    require_once "connection.php";

    if (!isset($_SESSION['UserID'])){
        echo 'User must be logged in to edit account';
    }
    else {
        list($email, $firstName, $lastName, $street, $city, $state, $zip, $billingMethod) =
            getUserDetails($_SESSION['UserID'], $conn);
        echo "
    <h3 class='text-center'>Edit Account</h3>

    <form id='login-form' action='editAccountCode.php' method='POST'>

        <div class='form-group'>
            <!-- <label>Email</label> -->
            <input type=text' name='email' class='
                    form-control' onchange='valChange(this)' placeholder=$email>
        </div
        <div class='form-group'>
            <!-- <label>Password</label> -->
            <input type='password' name='userpassword' class='form-control' onchange='valChange(this)' placeholder='New Password'>
        </div>

        <div class='form-group'>
            <!-- <label>First Name</label> -->
            <input type=text' name='firstname' class='
                    form-control' onchange='valChange(this)' placeholder=$firstName>
        </div
        <div class='form-group'>
            <!-- <label>Last Name</label> -->
            <input type=text' name='lastname' class='form-control' onchange='valChange(this)' placeholder=$lastName>
        </div>

        <div class='form-group'>
            <!--<label>Street</label> -->
            <input type=text' name='street' class='form-control' onchange='valChange(this)' placeholder=$street>
        </div>

        <div class='form-group'>
            <!--<label>City</label> -->
            <input type=text' name='city' class=' form-control' onchange='valChange(this)' placeholder=$city>
        </div>

        <div class='form-group'>
            <!--<label>State</label> -->
            <input type=text' name='stateabbreviation' class='form-control' onchange='valChange(this)' placeholder=$state>
        </div>

        <div class='form-group'>
            <!-- <label>Zip Code</label>-->
            <input type=text' name='zip' class='form-control' onchange='valChange(this)' placeholder=$zip>
        </div>


        <!--
        <div class='form-group'>
            <select required name='billingmethod' class='form-control' onchange='valChange(this)' placeholder='Visa'>
//                <option value=''disabled selected hidden>Change Payment Method</option>
                <option value='amex'>American Express</option>
                <option value='visa'>Visa</option>
                <option value='Discover'>Discover</option>
            </select>
        </div>-->
        <div><p></p></div>
        <input type='submit' name='btnRegister' class='btn-primary' value='Update'>
        <input type='hidden' id='changed' name='changed' value=''>
    </form>";
    }

    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'errorEmail') {
            //$value = $_GET['message'];
            echo 'Please provide a valid email';
        }
        elseif ($_GET['message'] == 'emailExists') {
            //$value = $_GET['message'];
            echo 'Email is not available';
        }
        elseif ($_GET['message'] == 'nothingChanged') {
            echo 'Nothing was changed';
        }
    }

    function getUserDetails($userID, $conn) {
        $query = "SELECT u.FirstName, u.LastName, u.Email, 
                    u.Street, u.City, u.StateAbbreviation, u.ZipCode, c.BillingMethod 
                    from Users u, Customer c WHERE u.UserID = ? and u.UserID = c.CustomerID;";
        $value = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($value, $query)) {  //check if query failed
            mysqli_stmt_close($value);
            header("location:login.php?message=badquery"); //send message
            exit();
        }

        mysqli_stmt_bind_param($value, "s", $userID);
        mysqli_stmt_execute($value);
        $result = mysqli_stmt_get_result($value);

        $row =  mysqli_fetch_assoc($result);
        return array($row['Email'], $row['FirstName'], $row['LastName'], $row['Street'], 
                        $row['City'], $row['StateAbbreviation'], $row['ZipCode'], $row['BillingMethod']);
    }


    ?>
</main>

<script>
    function valChange(object) {
        var old = document.getElementById("changed").value;
        if (old.length > 0) {
            document.getElementById("changed").value = old.concat(object.name + ";");
        } else {
            document.getElementById("changed").value = object.name + ";";
        }
    }

</script>

</body>

</html>