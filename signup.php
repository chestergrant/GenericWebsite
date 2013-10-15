<?php
session_start();
include_once 'script/common.php';
include_once 'classes/site.php';
$site = new site($db);
$error_firstname = "";
$error_lastname = "";
$error_email = "";
$error_password = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";
 if(isset($_POST['submit'])){
     $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $errors = false;
     if(emptyStr($firstname)){
         $errors = true;
         $error_firstname = "Please enter firstname";
     }
     if(emptyStr($lastname)){
         $errors = true;
         $error_lastname = "Please enter lastname";
     }
     if(emptyStr($email)){
         $errors = true;
         $error_email = "Please enter email";
     }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors = true;
         $error_email = "Invalid Email";
     }else if($site->alreadyUsed($email)){
         $errors = true;
         $error_email = "Email already exist";
     }
     if(emptyStr($password)){
         $errors = true;
         $error_password = "Please enter password";
     }else if(strlen($password) < 8){
         $errors = true;
         $error_password = "Password must be atleast 8 characters";
     }
     if(!$errors){
         $site->signup($firstname, $lastname, $email, $password);
         header( 'Location: dashboard.php' ) ;
         exit();
     }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Incentivize Weightloss</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" charset="utf-8" media="screen" href="css/style.css?<?php echo time();?>">        
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/signup.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="login.php" class="button"> Sign In</a></div>
        </div>
        <div id="main_panel">
           <form action="signup.php" method="post">
                    <input type="text" placeholder="Your First Name" name="firstname" value="<?php echo $firstname;?>"><br>
                    <input type="text" placeholder="Your Last Name" name="lastname" value="<?php echo $lastname;?>"><br> 
                    <input type="text" placeholder="Your Email" name="email" value="<?php echo $email;?>"><br> 
                    <input type="password" placeholder="Create Password" name="password" value="<?php echo $password;?>"><br>
                    <input type="submit" class="button" value="Create Account" name="submit"><br>
                   <div style="width:250px;font-size:13px"> By clicking on "Create account" above, you are agreeing to the <a target="_blank" href="terms.php">Terms of Service</a> and the <a target="_blank" href="privacy.php">Privacy Policy</a>.</div>        
                </form>     
              <div id="field_errors">
                  <span id="firstname-error" class="signup-error-bubble<?php if(emptyStr($error_firstname)){ echo " signup-error-correction";}?>"><?php if(!emptyStr($error_firstname)){ echo $error_firstname;}else{ echo "#";}?></span>
                  <span id="lastname-error" class="signup-error-bubble<?php if(emptyStr($error_lastname)){ echo " signup-error-correction";}?>"><?php if(!emptyStr($error_lastname)){ echo $error_lastname;}else{ echo "#";}?></span>
                  <span id="email-error" class="signup-error-bubble<?php if(emptyStr($error_email)){ echo " signup-error-correction";}?>"><?php if(!emptyStr($error_email)){ echo $error_email;}else{ echo "#";}?></span>
                  <span id="password-error" class="signup-error-bubble<?php if(emptyStr($error_password)){ echo " signup-error-correction";}?>"><?php if(!emptyStr($error_password)){ echo $error_password;}else{ echo "#";}?></span>
           
              </div>
        </div>    
    </body>       
</html>