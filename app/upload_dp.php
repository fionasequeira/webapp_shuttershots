<?php
  $invalid_search='';
  $input='';
  include('../includes/db_connect.php');  
  
  session_start();
  if(!isset($_SESSION['EmailID'])){
    session_destroy();
    header('Location: '.'login.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>ActiveSpace: Display Pciture</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container">
        <p align="center"> UPLOAD your DISPLAY PICTURE!</p>

        <form action="upload_dp.php" method="post" enctype="multipart/form-data">
        <br>
        <p align="center">Select image to upload:<br>
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="image" alt="Submit" src="img_submit.png" name="submitbutton" value="Submit" width="45" height="45"><br>
        </p>
        </form>
            <p>
            <?php
            
            // Check if image file is a actual image or fake image
            if(isset($_POST["submitbutton"])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        // Gets photo name
                        $filename = basename($_FILES["fileToUpload"]["name"]);

                        $id= "select user_id from userinfo where email_id like '".$_SESSION['EmailID']."';";
                        $result1=pg_query($id);
                        $id_op=pg_fetch_row($result1);
                        $query = "select upload_dp('".$filename."','".$id_op[0]."'); ";
                        $result = pg_query($query);
                        echo "File has been successfully uploaded! <br> Click on My Profile in navigation bar to check out your display picture!";
                    } 
                    // If moving a file does not work.
                    else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }    
            /*
            if(isset($_POST["submitbutton"])){     
                if(empty($_POST['Description'])) {
                    echo 'No Description';
                }
                else if(empty($_POST['fileToUpload'])) {
                    echo 'No File input';
                }
                else{
                    $id= "select user_id from userinfo where email_id like '".$_SESSION['EmailID']."';";
                    $result1=pg_query($id);
                    $id_op=pg_fetch_row($result1);
                    $query = "select upload_photo('".$_POST['Description']."','".$_POST['fileToUpload']."','".$id_op[0]."'); ";
                    $result = pg_query($query);
                    echo "File has been successfully uploaded! <br> Click on Photos in navigation bar to check out the latest uploads!";
                }
            }*/
        ?>      
      </p>
    </div>
  </body>
</html>