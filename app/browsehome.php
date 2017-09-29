<?php
$invalid_search='';
  $input='';
    include('../includes/db_connect.php');  
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: Gallery</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <div class= "container" align= "right">
      <p align = "center", float= "center">
         <?php
            echo 'WELCOME to the shuttershots gallery! <br> Click previous/next to navigate.';
            echo '<br>';
            echo '<br><br><br> Below you will find updates from our network.<br><br>';
            echo 'Like what you see? <button><a href="newuser.php" class="button">  Sign UP here! </a></button>';

             $offset= 0;

              if(isset($_GET['offset'])) {
                $offset= $_GET['offset'];
              if($offset == -10) {
                echo '<br>';
                echo '<br>';
                echo 'No new updates at this time';
                echo '<br>';
                echo '<br>';
                echo '<a href="browsehome.php?offset='.($offset+10).'"><button> * next * </button></a>';
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
                if ($row[2] == NULL) {
                  echo '<br> <i> No caption set  </i>';
                }
                else {
                echo '<b> " '.$row[2].' " </b>';
              }
                echo '<br> posted on "'.$row[3];
                echo '<br>';
                echo '<br>';
                echo '<br>';
                echo '<br>';
                echo '<br>';
                }               
            echo '<br>';
            echo '<br>';
            if($offset>=0){
              echo '<a href="browsehome.php?offset='.($offset-10).'"><button> * previous * </button></a>';
            }
            if(pg_num_rows($result_media) == 10) {
            echo '<a href="browsehome.php?offset='.($offset+10).'"><button> * next * </button></a>';
              }
            }
              else {
                echo "No more results available in the shuttershots gallery";
                echo '<br';
                echo '<a href="browsehome.php?offset='.($offset-10).'"><button> * previous * </button></a>';
                echo '<br>';
              }
            }
        ?>
      </p>
    </div>
  </body>
</html>
