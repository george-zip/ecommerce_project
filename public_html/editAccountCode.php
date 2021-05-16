<?php
session_start();
require_once "connection.php";

if ($conn==false) {
    //print message and exit current script
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["btnRegister"]) and strlen($_POST["changed"]) > 0) {

    $changedAttributes = $_POST["changed"];

    if(attributeChanged("email", $changedAttributes)) {
        echo $email = $_POST["email"];

        if (checkEmail($email) !== false)  //check email
        {
            header("location:EditAccount.php?message=errorEmail"); //send message
            exit();
        }

        if (checkEmailExists($email) !== false)  //check if account already exitst
        {
            header("location:register.php?message=emailExists"); //send message
            exit();
        }
    }

    $updateStr = createUpdateString($_POST, $_SESSION['UserID']);

    mysqli_begin_transaction($conn);
    try {
        mysqli_query($conn, $updateStr);  // update user table
    }
    catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        echo "New User not created successfully";
        header("location:EditAccount.php");
    }
    mysqli_commit($conn);

    echo "User updated successfully";
    header('Location:index.php');
}
else {
    header("location:EditAccount.php?message=nothingChanged");
    exit();
}

function attributeChanged($attributeName, $changedAttributes)
{
    if(strrpos($changedAttributes, $attributeName) !== False) {
        return True;
    }
    else {
        return False;
    }
}

function checkEmail($email)
    //checks if email format is valid
{
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        return true;
    }

    else {
        return false;
    }
}

function checkEmailExists($email)
    //check if account already exists
    //use prepared statements to avoid injection
{
    $qry = "SELECT * from users WHERE email = ?;";
    global $conn;
    $value = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($value,$qry)) {  //check if query failed
        header("location:register.php?message=emailBad"); //send message
        exit();
    }


    mysqli_stmt_bind_param($value,"s",$email);

    mysqli_stmt_execute($value);
    $result = mysqli_stmt_get_result($value);


    if ($row = mysqli_fetch_assoc($result)) {  //fetches a result row as an array
        //return $row;  //user exists
        return true;
    }
    else {
        return false;  //user doesn't exist
    }

    mysqli_stmt_close($value);
}

function createUpdateString($postVals, $userID) {
    $updateStr = "update Users set ";
    $changedAttributes = explode(";", $postVals["changed"]);
    foreach ($changedAttributes as $attribute) {
        if(strlen($attribute) > 0) {
            if($attribute == "userpassword") {
                $password = password_hash($postVals[$attribute], PASSWORD_DEFAULT);
                $updateStr .= $attribute . " = '" . $password . "', ";
            } else {
                $updateStr .= $attribute . " = '" . $postVals[$attribute] . "', ";
            }
        }
    }
    $updateStr = substr_replace($updateStr, "", -2);
    $updateStr .= " where UserID = " . $userID;
    return $updateStr;
}