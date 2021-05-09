
<?php
include_once'heading.php';  //navigation menu will be on all web pages
?>
    <div class=""container
        <div class="row">
            <div class="com-md-6">
                <div class="jumbotron">
                    <h2 class="text-center">
                        Welcome <?php echo $_SESSION['LoginUser']." You are a ". $_SESSION['Role']; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>