<?php
$Invalid_pwd='';
$ID='';
$PWD='';
include('../includes/db_connect.php'); 

#executes on submit button FROM log in form, it checks for invalid user/password else starts session  
if(isset($_POST["submitbutton"])){     
    if(empty($_POST['EmailID'])) {
        $ID= 'No Email ID input';
    }
    else if(empty($_POST['password'])) {
        $PWD= 'No Password input';
    }
    else{
        $query = "select * from userinfo where user_password = '".$_POST['password']."' and email_id= '".$_POST['EmailID']."';";
        $result = pg_query($query);
        if(pg_num_rows($result)>0){
            session_start();
            $_SESSION['EmailID']=$_POST['EmailID'];
            header('Location: '.'home.php');
        }
        else{
             $Invalid_pwd = 'Username or Password is invalid. Please try again!';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
    <title>Welcome to ShutterShots</title>
    <style type="text/css">
    body{
    height:100%;
    width:100%;
    margin-right: 5%;
    background-image:url("home.jpeg");
    background-size:cover;
    background-size: cover;
    font-size: 16px;
    font-family: 'Oswald', sans-serif;
    font-weight: 300;
    margin: 0;
    }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    </style>
    <div align="right">
         <form class="signin" action="login.php" align="right" method="post"> 

            <!-- FORM-Existing user LOGIN       -->
            <h4 class="heading"> shuttershots </h4>
            <h3 align="center"> New to shuttershots? View our gallery without signing in! </h3>
            <div align="center">
                <button> <a href="browsehome.php" class="button">lets browse!  </a></button> 
            </div>
            <br>
            <br>
            <h3 align="center"> Returning members, log in here! </h3>
            <input type="text" class="form-control" name="EmailID" placeholder="Email Address" autofocus="" />
            <input type="password" class="form-control" name="password" placeholder="Password" />      
            <br>
            <div align="center">
                <input type="image" alt="Submit" src="submit.png" name="submitbutton" value="Submit" width="70" height="70">
            </div> 
            <div align:"center"; style="color: red; background:rgba(0, 0, 0, .70); font-size: 15px;" ><?php echo $ID ?></div>
            <div align:"center"; style="color: red; background:rgba(0, 0, 0, .70); font-size: 15px;" ><?php echo $PWD ?></div>
            <div align:"center"; style="color: red; background:rgba(0, 0, 0, .70); font-size: 15px;" ><?php echo $Invalid_pwd ?></div>
          <br>              
        <div align="center">
        <button><a href="newuser.php" class="button">  Sign UP here! </a></button>
    </div>
        
        </form>
        <br>
        <br> 
        <br>

            <!-- New User SIGN UP LINK -->

</body>
</html>

          