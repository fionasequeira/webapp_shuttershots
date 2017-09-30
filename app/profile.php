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

<!-- displays users profile -->
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: My Profile</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container">
        <p align="center"> M   Y      P   R   O   F   I   L   E</p>
         <p>
         <?php
          if(isset($_SESSION['EmailID'])){ 
            $extract="select username,picture_medium,first_name,last_name,date_of_birth, last_log_in from userinfo where email_id='".$_SESSION['EmailID']."';" ;
          $finalresult=pg_query($extract);
          echo '<p>';
          while($info=pg_fetch_row($finalresult)){
           if($info[1]==NULL){
                  echo 'Click upload a display picture to get started!<br><a href=upload_dp.php><button> upload dp </button></a><br><br>';
                }
                else{
                   echo '<img class="imageformat" src="uploads/'.$info[1].'" align="center" width="80" height="80"><br>';
                }echo '<br><br>';
           echo 'USERNAME :'.$info[0].'<br>';            
           echo 'FULL NAME :'.$info[2]." ".$info[3].'<br><br>';
           echo 'Birthday :'.$info[4].'<br><br>';
           echo '<br> Last seen on Shuttershots :'.$info[5].'<br></p>';
         }
          }   
        ?>
      </p>
    </div>
  </body>
</html>
