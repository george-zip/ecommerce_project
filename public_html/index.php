<?php
 include_once'heading.php';  //navigation menu will be on all web pages
?>
        <section class="site-description">
            <h1>Welcome to Drum Center World !</h1>
         <h2><?php if(isset($_SESSION["Name"])) {
            echo "Check it out " . $_SESSION["Name"]."...We have the best gear in town</h2>";
            }
            else {
                echo "<h2>We have the best gear in town</h2>";
            }
            ?>
        </section>

        <section class="categories">
                <div>
                    <h3>

                        <a href="Category1.php?action=<?php echo "1";?>">Category 1</a>
                    </h3>
                </div>
                <div>
                    <h3>
                        <a href="Category1.php?action=<?php echo "2";?>">Category 2</a>
                    </h3>
                </div>
                <div>
                    <h3>
                        <a href="Category1.php?action=<?php echo "3";?>">Category 3</a>
                    </h3>
                </div>
                <div>
                    <h3>
                        <a href="Category1.php?action=<?php echo "4";?>">Category 4</a>
                    </h3>
                </div>

        </section>
</body>