<?php
session_start();
//echo $_SESSION['LoginUser'];
    if(!isset($_SESSION['LoginUser'])){
        //A user must be logged in to see this page
        header("location:Login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cymbals</title>
    <link rel="stylesheet" href="css/category-style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li>joe</li>
            <li>blow</li>
        </ul>
    </nav>
</header>
<main>
    <section class="category-links">
        <div class="wrapper">

            <h2>Category 1</h2>
            <div class= "category-container">
        <!--     start here -->
                <?php
                include_once 'connection.php';
                          $query = "SELECT * FROM product;";  //26:16
                            $stmt=mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$query)){
                                echo "Flex Box Query failed";
                            }
                            else {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo ' <a href="#">
                                            <div style="background-image: url(images/category/' . $row["PhotoLink"] . ');"></div>
                                    <h3>' . $row["Category"] . '</h3>
                                    <p>' . $row["Description"] . '</p>
                            </a>';

                                }
                            }
                            ?>
        <!--     end here -->

    </div>
        </div>

        <?php
        if (isset($_SESSION['Role']) && ($_SESSION['Role']==3 || $_SESSION['Role'])==4){
            echo '<div class="category-upload">
                    <form action="../includes/category-upload.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="filename" placeholder="File name">
                    <input type="text" name="filetitle" placeholder="Image title">
                    <input type="text" name="filedesc" placeholder="Image description">
                    <input type="file" name="file">
                    <button type="submit" name="submit">UPLOAD</button>
                </form>
            </div>';
        }

        ?>


    </section>
</main>
<div class="wrapper">
    <footer>
        <ul>
            <li></li>
        </ul>
    </footer>
</div>
</body>
</html>