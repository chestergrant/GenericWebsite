<?php
session_start();
include_once 'script/common.php';
include_once 'classes/site.php';
$site = new site($db);
$email = "";
$password = "";
$error_email = "";
$error_password = "";
$error_general = "";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = false;
    if(emptyStr($email)){
        $errors = true;
        $error_email = "Please enter email";
    }
    
    if(emptyStr($password)){
       $errors = true;
       $error_password = "Please enter password";
    }
    if(!$errors){
        $site->login($email,$password);
        if(emptyStr($site->loginErrors())== false){
            $errors = true;
            $error_general = "&bull; Couldn't login. Please try again.";
        }
    }
    if(!$errors){
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
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/login.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="signup.php" class="button"> Sign Up</a></div>
        </div>
        <div id="main_panel">
            <span id="user-error" class="user-error-bubble<?php if(emptyStr($error_general)){ echo " login-error-correction";}?>"><?php if(!emptyStr($error_general)){ echo $error_general;}else{ echo "#";}?></span>
           <form action="login.php" method="post">
               <input type="text" placeholder="Email" name="email" value="<?php echo $email;?>"><br> 
               <input type="password" placeholder="Password" name="password" value="<?php echo $password;?>"><br>
               <input type="submit" class="button" value="Sign In" name="submit"> 
           </form> 
            <div id="field_errors">
                 <span id="email-error" class="login-error-bubble<?php if(emptyStr($error_email)){ echo " login-error-correction";}?>"><?php if(!emptyStr($error_email)){ echo $error_email;}else{ echo "#";}?></span>
                 <span id="password-error" class="login-error-bubble<?php if(emptyStr($error_password)){ echo " login-error-correction";}?>"><?php if(!emptyStr($error_password)){ echo $error_password;}else{ echo "#";}?></span>
           
            </div>
            <div id="forgot">
                <a href="forgot.php">Forgot Password?</a>
            </div>    
        </div>    
    </body>       
</html>