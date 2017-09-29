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
<!-- Displaying all photos shared to the network  -->
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>ActiveSpace: Multimedia</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container">
        <p align="center">M Y      P H O T O S </p>
         <p>
         <?php
           if(isset($_SESSION['EmailID'])){
              $id= "select user_id from userinfo where email_id like '".$_SESSION['EmailID']."';";
              $result1=pg_query($id);
              $id_op=pg_fetch_row($result1);

              
              $query_media =  "select multimedia.content,multimedia.description,date(multimedia.post_time), media_id from userinfo, multimedia where userinfo.user_id=multimedia.user_id and multimedia.user_id ='".(int)$id_op[0]."' order by multimedia.post_time DESC;";
                
              $result_media=pg_query($query_media);
              
              echo '<p>';
              while($row = pg_fetch_row($result_media)){
                echo '<img class= "imageformat" src="uploads/'.$row[0].'">';
                echo '<br>';
                echo $row[1];
                echo '<br>';
                echo $row[2];
                echo '<br>';
                echo '<a href="edit_caption.php?photo='.$row[3].'"><button> edit </button></a>';
                echo '<a href="remove_photo.php?photo='.$row[3].'"><button> delete </button></a>';
                echo '<br>'; 
              }
              echo '</p>';
          }   
        ?>
      </p>
    </div>
  </body>
</html>
