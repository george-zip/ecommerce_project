<?php
session_start();

//if(!isset($SESSION['LoginUser']))
//{
//    header('Location: Login.php');
//}
//?>

<html>
<head>
    <title>Multi User Login Demo</title>
    <link rel="stylesheet" type="test/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
<div class=""container
<div class="row">
    <div class="com-md-6">
        <div class="jumbotron">
            <h2 class="text-center">
                Welcome <?php echo $_SESSION['AdminUser']." You are a ". $_SESSION['Role']; ?>
            </h2>
        </div>
    </div>
</div>
</div>
</body>
</html>
