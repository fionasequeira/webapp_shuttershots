<?php
  $invalid_search='';
  $input='';
  include('../includes/db_connect.php');  
// Starts a session  
  session_start();
// Updates last log in timestamp
  $query="Update userinfo set last_log_in=current_timestamp where email_id='".$_SESSION['EmailID']."';";
  $execute=pg_query($query);

  if(!isset($_SESSION['EmailID'])){
    session_destroy();
    header('Location: '.'login.php');

  }
?>

<!-- Directs existing user to livefeed from login page -->
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: Homepage</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class= "container" align= "right">
      <p align = "center", float= "center">
         <?php
            echo 'WELCOME to the shuttershots gallery! <br> Click previous/next to navigate.';
            echo '<br>';
            if(isset($_SESSION['EmailID'])){
              $query= "select username, picture_medium from userinfo where email_id='".$_SESSION['EmailID']."';";
              $result=pg_query($query);
              // Checks if user has previously assigned a display picture for himself, else notifies the user
              if($row = pg_fetch_row($result)){
                if($row[1]==NULL){
                  echo 'Click upload a display picture to get started!<br><a href=upload_dp.php><button> upload dp </button></a><br><br>';
                }
                else{
                   echo '<img class="imageformat" src="uploads/'.$row[1].'" align="center" width="80" height="80"><br>';
                }
                
                echo '<br>'.$row[0].'! Its good to see you up and running! <br><br>';
                // User has an option to upload an image with ready, set, shutter
                echo 'Share a PICTURE about your latest ventures<br>';
                echo '<a href="upload_photo.php"><button>   ready, set, shutter!    </button></a>';
              }

              echo '<br><br><br> Below you will find updates from our network.<br><br>';

             $offset= 0;
             // Offset monitors the photo by descending order of time posted
              if(isset($_GET['offset'])) {
                $offset= $_GET['offset'];
              if($offset == -10) {
                echo '<br>';
                echo '<br>';
                echo 'No new updates at this time';
                echo '<br>';
                echo '<br>';
                echo '<a href="home.php?offset='.($offset+10).'"><button> * next * </button></a>';
              }
            }
             echo '<br>';
             echo '<br>';
             if($offset>=0) {
              $query_media =  " select userinfo.username, multimedia.content, multimedia.description, date(multimedia.post_time), userinfo.email_id, multimedia.media_id from userinfo, multimedia WHERE userinfo.user_id = multimedia.user_id ORDER BY multimedia.post_time DESC LIMIT 10 OFFSET ".$offset.";";
              $result_media= pg_query($query_media);
              if(pg_num_rows($result_media)>0) {
                while($row = pg_fetch_row($result_media)){
                  echo $row[0];
                  echo '<br>';
                  echo '<img class= "imageformat" src="uploads/'.$row[1].'" align="center" width="450" height="400">';
                  echo '<br>'; 
                  if ($row[2]==NULL) {
                    echo '<br> <i> No caption set  </i>';
                  }
                  else {
                    echo '<b> " '.$row[2].' " </b>';
                  }
                  echo '<br> posted on "'.$row[3];
                  echo '<br>'; 
                  if ($row[4]==$_SESSION['EmailID']){
                    echo '<a href="edit_caption.php?photo='.$row[5].'"><button> edit </button></a>';
                    echo '<a href="remove_photo.php?photo='.$row[5].'"><button> delete </button></a>';
                  }
                  echo '<br>';
                  echo '<br>';
                  echo '<br>';
                  echo '<br>';
                  echo '<br>';
                }               
                echo '<br>';
                echo '<br>'; 
            // check if we havent reached out of latest gallery photos
                if($offset>=0){
                  echo '<a href="home.php?offset='.($offset-10).'"><button> * previous * </button></a>';
                }
            // check if we haved reached end of gallery
                if(pg_num_rows($result_media) == 10) {
                  echo '<a href="home.php?offset='.($offset+10).'"><button> * next * </button></a>';
                }
                else {
                  echo 'You have reached the end of our gallery <br>';
                }
            }
            else {
              echo "No more results available in the shuttershots gallery";
              echo '<br';
              echo '<a href="home.php?offset='.($offset-10).'"><button> * previous * </button></a>';
              echo '<br>';
            }
          }
        }
        ?>
      </p>
    </div>
  </body>
</html>
