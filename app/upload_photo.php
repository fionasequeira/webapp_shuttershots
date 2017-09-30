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

<!-- upload a new image to the system and network -->
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: SNAP IT</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container">
   

        <form action="upload_photo.php" method="post" enctype="multipart/form-data">
        <br>
        <p align="center">     <b><u>Share a SNAP today!</b></u>    <br> <br> Select image to upload:<br>
        <input type="text" class="description" name="Description" placeholder="Enter Image description" width ="70" height ="70"/>
        <input type="file" name="fileToUpload" id="fileToUpload" ><br>
        <input type="image" alt="Submit" src="img_submit.png" name="submitbutton" value="Submit" width="45" height="45"><br>
        </p>
        </form>
            <?php
            
            // Check if image file is a actual image or fake image
            if(isset($_POST["submitbutton"])) {

                if(getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "<p> File is an image - " . $check["mime"] . ".</p>";
                    $uploadOk = 1;
                } else {
                    echo "<p> File is not an image.</p>";
                    $uploadOk = 0;
                }
            
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "<p>Sorry, file already exists.</p>";
                    echo '<br>';
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "<p>Sorry, your file is too large.</p>";
                    echo '<br>';
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                    echo '<br>';
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<p>Sorry, your file was not uploaded.</p>";
                    echo '<br>';
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        // Gets description from POST 
                        $description = $_POST['Description'];
                        // Gets photo name
                        $filename = basename($_FILES["fileToUpload"]["name"]);

                        $id= "select user_id from userinfo where email_id like '".$_SESSION['EmailID']."';";
                        $result1=pg_query($id);
                        $id_op=pg_fetch_row($result1);
                        $query = "insert into multimedia values(DEFAULT, LOCALTIMESTAMP,'".$filename."','".$description."','".$id_op[0]."'); ";
                        $result = pg_query($query);
                        echo "<p>File has been successfully uploaded! <br> Click on Photos in navigation bar to check out the latest uploads! </p>";
                        echo '<br>';
                    } 
                    // If moving a file does not work.
                    else {
                        echo "Sorry, there was an error uploading your file.";
                        echo '<br>';
                    }
                }
            }
            else {
                echo "<p>Please enter an image file</p>";
                echo "<br>";
            }
        }
            
        ?>      
    </div>
  </body>
</html>