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

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <title>Shuttershots: Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
    <?php include('../includes/navbar.php'); ?>
    <br>
    <br>
    <br>
    <div class="homecontainer" align="center" float="center">
      <p>
        <?php
        echo "   Edit your profile ";
          if(isset($_SESSION['EmailID'])){
            $query = "SELECT * FROM userinfo where email_id = '".$_SESSION['EmailID']."'";
            $result = pg_query($db, $query);
              if($row = pg_fetch_assoc($result)){
                echo '<form method="POST">';
                echo '<p>';
                echo '<label>Username: <input type="text" name="form_username" value="'.htmlspecialchars( $row['username'] ).'" readonly required="" /></label><br>';
                echo '<label>Password: <input type="password" name="form_password" value="'.htmlspecialchars( $row['user_password'] ).'" required="" /></label><br>';
                echo '<label>First Name: <input type="text" name="form_first" value="'.htmlspecialchars( $row['first_name'] ).'" required="" /></label><br>';
                echo '<label>Last Name: <input type="text" name="form_last" value="'.htmlspecialchars( $row['last_name'] ).'" required="" /></label><br>';
                echo '<label>Email ID: <input type="email" name="form_email" value="'.htmlspecialchars( $row['email_id'] ).'" readonly required="" /></label><br>';
                echo '<label>Date of Birth: <input type="date" name="form_dob" value="'.htmlspecialchars( $row['date_of_birth'] ).'" ></label><br>';
                echo '<br><br>'; 
                echo '<input type="submit" value="Submit" name="edituser_submit" width="100" height="100">';
                echo '<input type="reset" width="100" height="100">';                
                echo '</p>';
                echo '</form>';
            }
          }
        ?>
      </p>
        </div>
</body>
</html>
<?php
    if(isset($_POST["edituser_submit"])){ 
      $query = "UPDATE userinfo SET user_password = '$_POST[form_password]', first_name = '$_POST[form_first]', last_name = '$_POST[form_last]', date_of_birth = '$_POST[form_dob]', last_log_in = LOCALTIMESTAMP WHERE email_id = '$_SESSION[EmailID]';";
      $rs = pg_query($db, $query) or die("Cannot execute query: $query\n");
      echo '<p align ="center">';
      echo "User information edited successfully. <br>";
      echo '<a href="home.php"><button align="center"> Livefeed </button></a> </p>';
  }
?>
