<?php

if (isset($_POST['submit'])) {
    $newFileName=$_POST['filename'];
    if (empty($newFileName)) {
        $newFileName="category";  //default value
    } else{
        $newFileName=strtolower(str_replace(" ", "-",$newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];
   $imagePrice = $_POST['fileprice'];
    $imagePrice2 = (float)$imagePrice;
    $imageQuantity = $_POST['filequantity'];
    $imageQuantity2 = (int)$imageQuantity;

    $file = $_FILES['file'];
    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError  =$file["error"];
    $fileSize = $file["size"];

    echo nl2br("filename: ". "$fileName" . "\n");
    echo nl2br("filetype: ". "$fileType" . "\n");
    echo nl2br("fileTempName: ". "$fileTempName" . "\n");
    echo nl2br("filesize: ". " $fileSize" . "\n");
    echo nl2br("newfilename: ". " $newFileName" . "\n");

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array("jpg","jpeg","png");
    if (in_array($fileActualExt,$allowed)){
            if ($fileError==0){
                if ($fileSize < 2000000){
                    $imageFullName = $newFileName . "." . uniqid("",true).".".$fileActualExt;
                    $fileDest = "../public_html/images/category/" . $imageFullName;  //where to store the image
                    echo nl2br("imageFullName: ". " $imageFullName" . "\n");
                    echo nl2br("imagedest: ". " $fileDest" . "\n");
                    include_once "../public_html/connection.php";
                    if(empty($imageTitle) || empty($imageDesc)) {
                        header("Location: ../public_html/Category1.php?message=empty");
                        exit();
                    }else {
                        $query = "SELECT * FROM product;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt,$query)){
                            echo "error in query";
                        }
                        else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);
                            $setImageOrder = $rowCount+1;

                            $query = "INSERT INTO product (Category, Description,PhotoLink,AvailableQty,Price) 
                                        VALUES (?,?,?,?,?);";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt,$query)){
                                echo "error in query";
                            }
                            else {
                                echo "'$imageTitle'.'$imageDesc'.'$imageFullName'";
                                mysqli_stmt_bind_param($stmt, "sssid",$imageTitle,$imageDesc,$imageFullName,$imageQuantity2,$imagePrice2 );
                                mysqli_stmt_execute($stmt);
                                move_uploaded_file($fileTempName,$fileDest);  //move actual image
                                header("Location: ../public_html/Category1.php?message=fileload");
                            }
                        }
                    }
                }
            }
            else{
                echo "Error Occurred";
                exit();
            }
    }
    else{
        echo "You need to upload a proper file type";
        exit();
    }
}