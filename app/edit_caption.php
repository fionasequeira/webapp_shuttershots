<?php
  // $invalid_search='';
  // $input='';
  include('../includes/db_connect.php');  
  
  session_start();
  if(!isset($_SESSION['EmailID'])){
    session_destroy();
    header('Location: '.'login.php');
  }
?>

<!-- user can change the caption of the image displayed -->
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: Edit Image Caption</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="homecontainer">
      <p align ="Center" float="center">
        <?php
          echo "   Edit your Image Caption ";
          if(isset($_SESSION['EmailID'])){
            $queryd = "SELECT user_id FROM userinfo WHERE email_id = '$_SESSION[EmailID]';";
            $resd = pg_query($queryd) or die("Cannot execute query: $queryd\n");
            $uidd = pg_fetch_row($resd);
           if($_GET['photo']){
           (int)$photo_id=$_GET['photo'];
            $query = "SELECT * FROM multimedia where media_id = ".$photo_id." AND user_id = ".$uidd[0].";";
            $result = pg_query($db, $query);
              if($row = pg_fetch_assoc($result)){
                echo '<form method="POST">';
                echo '<p>';
                
                echo '<img class= "imageformat" src="uploads/'.$row['content'].'" align="center" width="150" height="150"> <br>';
                echo '<label> CAPTION: <input type="text" name="form_description" value="'.htmlspecialchars( $row['description'] ).'" /></label><br>';
                echo '<label> POSTED ON: <input type="text" value="'.htmlspecialchars( $row['post_time'] ).'" readonly /></label><br>';
                echo '<br><br>'; 
                echo '<input type="submit" value="Submit" name="edit_caption_submit" width="100" height="100">';
                echo '<input type="reset" width="100" height="100">';                
                echo '</p>';
                echo '</form>';
            }
          }
        }
        ?>
      </p>
        </div>
</body>
</html>
<?php
    if(isset($_POST["edit_caption_submit"])){ 
      $query = "UPDATE multimedia SET description = '$_POST[form_description]' WHERE media_id='".$_GET['photo']."';" ;
      $rs = pg_query($db, $query) or die("Cannot execute query: $query\n");
      echo "<p> Image caption edited successfully.<br>";
      echo '<a href="home.php"><button align="center"> Livefeed </button></a> </p>';
  }
?>
