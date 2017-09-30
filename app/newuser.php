<?php
  $invalid_search='';
  $input='';
  $msg='';
  include('../includes/db_connect.php');  
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <title>Shuttershots: New User</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/styles/home.css">
</head>

<body>
  
  <a href="home.php" color="white"><h4> shuttershots </h4></a>
  <div align:"center"; style="color: red; background:rgba(0, 0, 0, .70); font-size: 20px;" ><?php echo $msg ?></div>
<!-- checks for existing user, else enters new user details in the backed -->
  <?php
    if(isset($_POST["newuser_submit"])){ 

        $querya = "SELECT email_id FROM userinfo WHERE email_id like '$_POST[form_email]';";
        $resa = pg_query($querya) or die("Cannot execute query: $query\n");
        
        $query = " SELECT username from userinfo where username = '$_POST[form_username]' ";
        $result = pg_query($query);
        if(pg_num_rows($result)>0){
    }


        if(pg_num_rows($result)>0){
          echo "<p align='center'>Email already exists. Please go back and login with your credentials.</p>";
        }
        else if(pg_num_rows($resa)>0){
            echo "<p align='center'>Username already exists. Please choose a different username.</p>";
        }
        else{
          $query = "INSERT INTO userinfo VALUES (DEFAULT,LOCALTIMESTAMP,'$_POST[form_email]','$_POST[form_username]','$_POST[form_password]','$_POST[form_first]','$_POST[form_last]','$_POST[form_dob]',NULL,LOCALTIMESTAMP);";
        
          $rs = pg_query($db, $query) or die("Cannot execute query: $query\n");
          echo "<p align='center'>New user created successfully. Please log in with your email ID and password on the login screen.</p>";
          echo '<a href="login.php><button> LOGIN </button></a>';}
    }  
  ?>
    </div>

    
<!-- Form for user to fill out details about them -->
      <div class="container" align="center"> 
      <form align="center" method="POST">
        <p float ="center">
     <label>Username: <input type="text" name="form_username" required="" /></label><br>
     <label>Password: <input type="password" name="form_password" required="" /></label><br>
     <label>First Name: <input type="text" name="form_first" required="" /></label><br>
     <label>Last Name: <input type="text" name="form_last" required="" /></label><br>
     <label>Email ID: <input type="email" name="form_email" required="" /></label><br>
     <label>Date of Birth: <input type="date" name="form_dob" required="" /></label><br>     
        <input type="submit" alt="Submit" src="submit.png" name="newuser_submit" width="80" height="80">
        <input type="reset" alt="Submit" src="submit.png" name="resetbutton" width="80" height="80">
        </p>
      </form>
      </div>
</body>
</html>
